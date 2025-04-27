# -*- coding:utf-8 -*-
import time
from app import MysqlDB
from sqlalchemy import and_,or_

class config(MysqlDB.Model):
    __tablename__ = 'cuteone_config'
    id = MysqlDB.Column(MysqlDB.INT, primary_key=True)
    name = MysqlDB.Column(MysqlDB.String(255), unique=False)
    title = MysqlDB.Column(MysqlDB.String(255), unique=False)
    value = MysqlDB.Column(MysqlDB.String(255), unique=False)
    update_time = MysqlDB.Column(MysqlDB.DateTime(255), default=time.strftime('%Y-%m-%d %H:%M:%S'), onupdate=time.strftime('%Y-%m-%d %H:%M:%S'))
    create_time = MysqlDB.Column(MysqlDB.DateTime(255), default=time.strftime('%Y-%m-%d %H:%M:%S'))

    @classmethod
    def all(cls):
        data = {}
        for i in cls.query.all():
            data[i.name] = i.value
        MysqlDB.session.close()
        return data

    # 校正账号密码是否正确
    @classmethod
    def checkpassword(cls, username, password):
        userdata = MysqlDB.session.query(cls).filter(cls.name == "username").one()
        passdata = MysqlDB.session.query(cls).filter(cls.name == "password").one()
        MysqlDB.session.close()
        if username == userdata.value:
            if password == passdata.value:
                return {"code":True, "msg":""}
            else:
                return {"code": False, "msg": "密码错误！"}
        else:
            return {"code": False, "msg": "账号错误！"}


    @classmethod
    def get_config(cls, table):
        data = MysqlDB.session.query(cls).filter(cls.name == table).one()
        MysqlDB.session.close()
        return data.value


    @classmethod
    def update(cls, data):
        MysqlDB.session.query(cls).filter(cls.name == data['name']).update(data)
        MysqlDB.session.flush()
        MysqlDB.session.commit()
        return