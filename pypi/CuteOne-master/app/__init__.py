# -*- coding:utf-8 -*-
from flask import Flask
from flask_login import LoginManager
from flask_socketio import SocketIO
from flask_sqlalchemy import SQLAlchemy
from flask_pymongo import PyMongo


login_manager = LoginManager()

#创建app应用,__name__是python预定义变量，被设置为使用本模块.
app = Flask(__name__)
login_manager.init_app(app)
app.debug = False    # 设置调试模式，生产模式的时候要关掉debug
app.config.from_object('config')
MysqlDB = SQLAlchemy(app)
MongoDB = PyMongo(app)

async_mode = None
socketio = SocketIO(app, async_mode=async_mode)



# 蓝图注册路由文件
from app import routes