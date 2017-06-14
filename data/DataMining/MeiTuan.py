# -*- coding:utf-8 -*-
"""
   @author:wjl
   2017.4.16
   目的是爬取美团餐饮的评论以作为舆情分析的数据
   采用了selenium(Xpath)驱动+BeautifulSoup爬取
"""

# selenium
from selenium import webdriver
# 等待下一页按钮加载出来
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException,NoSuchElementException
# BeautifulSoup
from bs4 import BeautifulSoup
# 用于隐式等待
import  time
# 正则表达式，用于从网址中取出商家编号
import re
# 设置默认编码，python2.7默认编码为ASCII，故经常遇上编码错误的问题。该问题可通过下列设置避免
import sys
reload(sys)
sys.setdefaultencoding('utf8')

class MeiTuan:
    # ------------------------------------------------初始化-----------------------------------------------------
    def __init__(self):
        # 设置美团商家网址，包含商家编号
        self.url = 'http://www.meituan.com/deal/29228986.html?mtt=1.index%2Ffloornew.im.55.j1lny2d7'
        # 利用正则表达式从商家网址中取出商家编号，不同商家网址会有些许区别
        self.resNo = re.findall(re.compile('http://www.meituan.com/deal/(.*?).html'),self.url)[0]
        # selenium初始化
        self.driver = webdriver.Firefox()
        self.driver.get(self.url)
        # 设置页码
        self.num = 1
        # 设置列表，用于存储每条评论的信息
        self.total = []
        # 设置秒表起点，用于计算程序运行时间
        time.clock()
        # self.driver.get_screenshot_as_file("123.png")  # 截图

    # ------------------------------------------------启动-----------------------------------------------------
    def start(self):

        # 这里好像不能用浏览器显式等待
        # 等待评论区标志物出现
        WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located(
                (By.XPATH, "//a[@class='rate-filter__link J-filter-link rate-filter__link--active']"))
        )

        # 将标志物的末端与当前窗口顶部齐平，虽然实际操作会有偏差
        elem = self.driver.find_element_by_xpath("//a[@class='rate-filter__link J-filter-link rate-filter__link--active']")
        js = "arguments[0].scrollIntoView(true);"
        self.driver.execute_script(js,elem)

        # 判断有无下一页
        while self.isNext():
            # 页码自增
            self.num = self.num + 1
            # 点击“下一页”按钮
            nextButton = self.driver.find_element_by_xpath("//li[@class='next']/a[@gaevent='content/detail/reviews/prepagenextpage']")
            nextButton.click()





        # ------------------------------------------------处理数据-----------------------------------------------------
    def deal(self,pageCode):

        # 初始化soup
        soup = BeautifulSoup(pageCode, "lxml")

        # 遍历每一条每一条评论
        for sentence in soup.find_all("li",class_ = "J-ratelist-item rate-list__item cf"):
            # 商家编号
            No =  str(self.resNo)
            # 用户名
            UserNo = sentence.find("p",class_ = "name-wrapper").contents[1].string
            # 日期
            date =  sentence.find("span", class_="time").string
            # 评分
            mark = str(int(sentence.find("span",class_ = "rate-stars")["style"][6:][0:-1])/20)+"分"
            # 将信息组合
            temp = No + "\t"+ UserNo + "\t" + date + "\t"+ mark + "\t"
            # 评论
            if len(sentence.find("p",class_ = "content").contents) == 1:
                evaluation =  sentence.find("p",class_ = "content").contents[0].strip()
            elif len(sentence.find("p",class_ = "content").contents) == 3:
                evaluation = sentence.find("p", class_="content").contents[2].strip()
            elif len(sentence.find("p",class_ = "content").contents) == 4:
                evaluation = sentence.find("p", class_="content").contents[3].strip()
            # 若评论为“无”，则跳过该条评论
            if evaluation == "无":
                continue

            # 将评论加入信息组合
            temp= temp + evaluation
            # 将每一条评论中的信息存入列表中
            self.total.append(temp.replace("\n"," "))

    # ------------------------------------------------判断有无下一页-----------------------------------------------------
    """
       美团评论爬取的时候会遇到四种情况：
       1.正常情况，有评论，有上一页，有下一页
       2.尾页，有评论，有上一页，无下一页
       3.加载超时，无评论，有上一页，有下一页（但按不了）
       4.死胡同，无评论，无上一页，无下一页（无法避免只能重新运行程序）
    """
    def isNext(self):

        # 输出当前页码
        print "第" + str(self.num) + "页"

        # 在判断是否有“下一页”按钮之前，将当前页面源代码传入deal（）处理
        self.deal(self.driver.page_source)

        # 设置浏览器显式等待
        try:
            # 等待下一页按钮加载，超时时间设置为10秒，默认0.5秒检查一次是否加载
            WebDriverWait(self.driver, 10).until(
                EC.presence_of_element_located((By.XPATH, "//li[@class='next']/a[@gaevent='content/detail/reviews/prepagenextpage']"))
            )

        # 若超时
        except TimeoutException:

            # 则通过评论数判断评论是否加载出来了
            if len(BeautifulSoup(self.driver.page_source, "lxml").find_all("li",class_ = "J-ratelist-item rate-list__item cf")) > 0:
                # 此为最后一页
                self.save()
                return False
            # 若评论未加载，则可能是暂时没加载出来需要返回上一页，也可能是死胡同了

            else:
                # 则输出
                print "加载超时"
                # 返回上一页（因为在判断是否有“下一页”按钮之前已经将上一页的页面源代码传入deal（）函数了，
                # 故返回上一页后会立即重新点击“下一页按钮”回当前页进而重新运行isNext（）函数，而不会再传一次上一页的页面源代码）
                # 唯一的问题就是页数还是会多增加1
                try:
                    preButton = self.driver.find_element_by_xpath(
                        "//li[@class='previous']/a[@gaevent='content/detail/reviews/prepageprepage']")
                    preButton.click()
                # 若既无下一页按钮，又无上一页按钮，则为死胡同，保存并离开
                except NoSuchElementException:
                    print "死胡同"
                    self.save()
                    return False
                print "返回上一页重新加载"
                return True

        # 判断“下一页”按钮中链接数是否大于0，因为最后一页的下一页按钮链接数等于0
        nextButton = self.driver.find_elements_by_xpath("//li[@class='next']/a[@gaevent='content/detail/reviews/prepagenextpage']")
        if len(nextButton) > 0:
            return True
        else:
            # 若为最后一页，输出运行时间
            self.save()
            return False

    # ------------------------------------------------存文本-----------------------------------------------------
    def save(self):
        print "结束"
        print "已运行", time.clock() / 60, "分钟"
        # 打开文件并存入字符串
        with open('E:\\softwaredata\\workspace\\PycharmProjects\\WebSpider2.7\\result1.txt', 'w') as f:
            f.write("\n".join(self.total))

if __name__ == '__main__':
    meituan = MeiTuan()
    meituan.start()

