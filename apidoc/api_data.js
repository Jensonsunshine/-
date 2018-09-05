define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./apidoc/main.js",
    "group": "D__UPUPW_ANK_W64_WebRoot_Vhosts_www_local_yanxishe_cc_apidoc_main_js",
    "groupTitle": "D__UPUPW_ANK_W64_WebRoot_Vhosts_www_local_yanxishe_cc_apidoc_main_js",
    "name": ""
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./public/apidoc/main.js",
    "group": "D__UPUPW_ANK_W64_WebRoot_Vhosts_www_local_yanxishe_cc_public_apidoc_main_js",
    "groupTitle": "D__UPUPW_ANK_W64_WebRoot_Vhosts_www_local_yanxishe_cc_public_apidoc_main_js",
    "name": ""
  },
  {
    "type": "post",
    "url": "/Main/my_release",
    "title": "我发布的",
    "group": "Main",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>判断状态 1 我发布  0 我收到的</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "size",
            "description": "<p>条数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_name",
            "description": "<p>项目名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "deadline",
            "description": "<p>截至日期</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "createtime",
            "description": "<p>发布时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "share_count",
            "description": "<p>转发次数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "read_count",
            "description": "<p>阅读次数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "attention_count",
            "description": "<p>意向人数</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_reward",
            "description": "<p>转发赏金</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "shared",
            "description": "<p>0未分享，1已分享</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "share_id",
            "description": "<p>分享id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n  code:200,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Main.php",
    "groupTitle": "Main",
    "name": "PostMainMy_release"
  },
  {
    "type": "post",
    "url": "/Main/pro_info",
    "title": "项目发布",
    "group": "Main",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_name",
            "description": "<p>项目标题</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_desc",
            "description": "<p>项目描述</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_imgs",
            "description": "<p>项目照片（逗号隔开）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "deadline",
            "description": "<p>截止日期</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pre_reward",
            "description": "<p>预设赏金</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "share_word",
            "description": "<p>推荐语</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n\t\"code\": 200,\n\t\"msg\": \"发布成功\",\n\t\"data\":{\n\t\t\"pro_id\":1\n\t}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Main.php",
    "groupTitle": "Main",
    "name": "PostMainPro_info"
  },
  {
    "type": "post",
    "url": "/Orders/order_delete",
    "title": "删除项目",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_delete"
  },
  {
    "type": "post",
    "url": "/Orders/order_detail",
    "title": "我发出的项目列表、详情",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID用户</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>项目详情</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_name",
            "description": "<p>项目标题</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_desc",
            "description": "<p>项目内容</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_imgs",
            "description": "<p>项目图片</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "deadline",
            "description": "<p>项目截止时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "createtime",
            "description": "<p>项目创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pre_reward",
            "description": "<p>项目赏金</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "real_reward",
            "description": "<p>项目真实赏金</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_status",
            "description": "<p>项目状态</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "share_count",
            "description": "<p>项目分享数</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "read_count",
            "description": "<p>项目阅读数</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "attention_count",
            "description": "<p>咨询数量</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n\t  pro_title:\"xxxxx\",\n\t  pro_content:\"xxxxxxxxxxxxxxxxxxxxxxx\",\n\t  pro_pics:\"xxxxx,xxxxx\",\n\t  pro_endTime:\"2018-08-02\",\n\t  pro_money:\"100\",\n\t  pro_status:\"1\",\n\t  pro_shares:\"123\",\n\t  pro_asks:\"321\",\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_detail"
  },
  {
    "type": "post",
    "url": "/Orders/order_edit",
    "title": "编辑",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_name",
            "description": "<p>项目名称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_desc",
            "description": "<p>项目内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_imgs",
            "description": "<p>项目图片</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "deadline",
            "description": "<p>项目截止时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pre_reward",
            "description": "<p>项目赏金</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_edit"
  },
  {
    "type": "post",
    "url": "/Orders/order_is_share",
    "title": "转发状态",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "share_id",
            "description": "<p>分享ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "share_status",
            "description": "<p>分享状态（0，可分享，1，不可分享）</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_is_share"
  },
  {
    "type": "post",
    "url": "/Orders/order_myshare",
    "title": "由我转发",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_myshare"
  },
  {
    "type": "post",
    "url": "/Orders/order_resend",
    "title": "转发",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "source_user_id",
            "description": "<p>发起人ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "share_user_id",
            "description": "<p>分享人ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "receive_user_id",
            "description": "<p>接收人ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "share_word",
            "description": "<p>推荐语</p>"
          },
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "share_url",
            "description": "<p>分享链接</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_resend"
  },
  {
    "type": "post",
    "url": "/Orders/order_reward",
    "title": "打赏",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int[]",
            "optional": false,
            "field": "reward_user_id",
            "description": "<p>打赏者ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "money",
            "description": "<p>打赏金额</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "get_reward_user_id",
            "description": "<p>收到打赏者ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>项目打赏</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_reward"
  },
  {
    "type": "post",
    "url": "/Orders/order_reward_list",
    "title": "已打赏list",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>项目打赏</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_reward_list"
  },
  {
    "type": "post",
    "url": "/Orders/order_status",
    "title": "修改项目状态",
    "group": "Order",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pro_id",
            "description": "<p>项目ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pro_status",
            "description": "<p>项目状态（0，转发中，1，已关闭，2，已过期）</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " HTTP/1.1 200 OK\n{\n  code:0,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Orders.php",
    "groupTitle": "Order",
    "name": "PostOrdersOrder_status"
  },
  {
    "type": "post",
    "url": "/Pay/cash",
    "title": "提现",
    "group": "Pay",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "money_number",
            "description": "<p>授权状态码</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "正确返回值:",
          "content": " HTTP/1.1 200 OK\n{\n  code:200,\n  msg:'提现成功',\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'提现失败',\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Pay.php",
    "groupTitle": "Pay",
    "name": "PostPayCash"
  },
  {
    "type": "post",
    "url": "/Pay/recharge",
    "title": "账户充值",
    "group": "Pay",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "body",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "out_trade_no",
            "description": "<p>商品订单号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "total_fee",
            "description": "<p>标价金额</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "spbill_create_ip",
            "description": "<p>终端ip</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "money_number",
            "description": "<p>价钱</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "正确返回值:",
          "content": " HTTP/1.1 200 OK\n{\n  code:200,\n  msg:'充值成功',\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'充值失败',\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Pay.php",
    "groupTitle": "Pay",
    "name": "PostPayRecharge"
  },
  {
    "type": "post",
    "url": "/Upload/upload_file",
    "title": "上传文件",
    "group": "Upload",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "object",
            "optional": false,
            "field": "file",
            "description": "<p>文件对象</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "path",
            "description": "<p>文件上传路径</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": " HTTP/1.1 200 OK\n{\n  code:200,\n  msg:'上传成功',\n  data:{ \n\t  path：http://xxx.com/upload/xxx.jpg\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "{\n  code:200,\n  msg:'上传失败',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Upload.php",
    "groupTitle": "Upload",
    "name": "PostUploadUpload_file"
  },
  {
    "type": "post",
    "url": "/users/edit_user_info",
    "title": "编辑用户信息",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_phone",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_compony",
            "description": "<p>公司名称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_img",
            "description": "<p>用户头像</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "calling",
            "description": "<p>用户在职公司名称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_area",
            "description": "<p>用户所在区域</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_lable",
            "description": "<p>标签</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n\t\"code\": 200,\n\t\"msg\": \"信息修改成功\",\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersEdit_user_info"
  },
  {
    "type": "post",
    "url": "/users/user_bill",
    "title": "资金明细",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "item_type",
            "description": "<p>0 全部 1 收入 2 支出</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "size",
            "description": "<p>条数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "item_name",
            "description": "<p>收支项目名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "createtime",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "item_account",
            "description": "<p>项目费用</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n  code:200,\n  msg:'success',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "{\n\tcode:201,\n\tmsg:'error',\n\tdata:{}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersUser_bill"
  },
  {
    "type": "post",
    "url": "/users/user_info",
    "title": "用户信息",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>用户信息</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_phone",
            "description": "<p>用户手机号</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_title",
            "description": "<p>用户职位</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_compony",
            "description": "<p>用户公司名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_balance",
            "description": "<p>账户余额</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "user_img",
            "description": "<p>头像地址</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "pro_count",
            "description": "<p>发布任务次数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n  code:200,\n  msg:'success',\n  data:{ \n\t  'user_nickname':'张三',\n\t  'user_phone':18888888888,\n\t  'user_title':'总裁'\n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersUser_info"
  },
  {
    "type": "post",
    "url": "/users/user_login",
    "title": "用户登录",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>授权状态码</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": " HTTP/1.1 200 OK\n{\n  code:200,\n  msg:'success',\n  data:{ \n\t  user_id：1\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "HTTP/1.1 201 \n{\n  code:201,\n  msg:'error',\n  data:{ \n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersUser_login"
  },
  {
    "type": "post",
    "url": "/users/user_res",
    "title": "用户注册",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "user_phone",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_compony",
            "description": "<p>公司名称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_img",
            "description": "<p>用户头像</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "calling",
            "description": "<p>用户在职公司名称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_area",
            "description": "<p>用户所在区域</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_lable",
            "description": "<p>标签</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "正确返回值:",
          "content": " HTTP/1.1 200 OK\n{\n  code:200,\n  msg:'注册成功',\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "{\n  code:201,\n  msg:'注册失败',\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersUser_res"
  },
  {
    "type": "post",
    "url": "/users/usual_question",
    "title": "常见问题",
    "group": "User",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>请求一个问题的详细</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "object",
            "optional": false,
            "field": "list",
            "description": "<p>常见问题列表</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "正确返回值:",
          "content": "{\n\t\"code\": 200,\n\t\"msg\": \"返回常见问题列表成功\",\n\t\"data\": [{\n\t\t\"title\": \"什么是赏金猎人\",\n\t\t\"content\": \"赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。\"\n\t}, {\n\t\t\"title\": \"什么是赏金猎人\",\n\t\t\"content\": \"赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。\"\n\t}, {\n\t\t\"title\": \"什么是赏金猎人\",\n\t\t\"content\": \"赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。\"\n\t}, {\n\t\t\"title\": \"什么是赏金猎人\",\n\t\t\"content\": \"赏金猎人是一款通过朋友不能转发找到项目合作者的软件。。。。。。。\"\n\t}]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "错误返回值:",
          "content": "{\n\tcode:201,\n\tmsg:'返回常见问题列表失败',\n\tdata:{}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./application/index/controller/Users.php",
    "groupTitle": "User",
    "name": "PostUsersUsual_question"
  }
] });
