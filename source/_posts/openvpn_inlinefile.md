title: "[OpenVPN] OpenVPN独立配置文件"
id: 62
date: 2009-05-17 17:47:03
tags: 
- inline
- openvpn
- tls-auth
- 内置证书
- 证书
categories: 
- 系统相关/OpenVPN
description: 把OpenVPN 所有需要的证书内置到配置文件中,只要一个配置文件就可以使用,方便实用

---

### [OpenVPN] OpenVPN 独立配置文件

前言: OpenVPN使用证书连接可以加强安全性但是如果客户端多了要分发证书很不方便,还有如果一个客户端需要连接多个不同的服务器,一般情况下证书文件都使用默认的文件名

例子对于**CA**根证书一般使用如下语句:
```
ca ca.crt
```

由于不同的服务器需要的证书是不一样的,所以只能改名这样一来也很麻烦

OpenVPN 2.1 版新增功能,可以把证书文件等内置到配置文件中(Inline files)

需要 OpenVPN 2.1-beta7 以上的版本才支持..!!!

<!--more-->

### 支持内置的证书类型

* **secret**
* **ca**
* **dh**
* **cert**
* **key**
* **tls-auth**


### 内置方法

使用一个类似**XML**格式的脚本来加载这些文件

例子对于**CA**根证书可以使用如下方法
```
<ca>
证书内容
证书内容
证书内容
</ca>
```

其它的文件内置方法同**CA**也就是
```
<类型>
文件内容
</类型>
```

对于**tls-auth**可能需要再增加一个选项如下

```
key-direction 1 # 客户端1,服务端是0
```

### 实际的例子

以下内容来源于网络:

```
remote 1.2.3.4 
client 
proto tcp 
port 1194 
dev tun 
ns-cert-type server 
auth-user-pass 
auth-retry interact 
comp-lzo 
verb 3 

<ca> 
-----BEGIN CERTIFICATE----- 
MIIBszCCARygAwIBAgIESbWTdDANBgkqhkiG9w0BAQUFADAVMRMwEQYDVQQDEwpP 
cGVuVlBOIENBMB4XDTA5MDMwOTIyMDg1MloXDTE5MDMwNzIyMDg1MlowFTETMBEG 
A1UEAxMKT3BlblZQTiBDQTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAyaBW 
oE6HBiNa6ZVNqyTjTM4lHDyRRw8oKnGWi795aJJLNz35ahAbK7MhSMt6CCzt3PnD 
yHueDu9G2PswfXHB8dqyxvbOV+xvf61BcLVkuindGYXLBE0CIeLCc9IMbhlkw5oT 
eVUoPOcy4YIByXyNmx6tQg5l0wrN89xrVCcG3iUCAwEAAaMQMA4wDAYDVR0TBAUw 
AwEB/zANBgkqhkiG9w0BAQUFAAOBgQBeQnkA3EVpfQmbprMhWMswBvimnQpXXshu 
XvNp+Q8BPs+DLxEs6L0DPB9n4qSGjcGVATRsy3iKmGoraRtwz5yxGRcsTru2j9jF 
KbLuVCzzlYzeX7Ysle+eKif82qDX5bRxjjOo0bYONcPZHCYf2Of3uSj4fie02GzR 
/chO7oasBA== 
-----END CERTIFICATE----- 
</ca> 

<cert> 
-----BEGIN CERTIFICATE----- 
MIIBzDCCATWgAwIBAgIBAjANBgkqhkiG9w0BAQUFADAVMRMwEQYDVQQDEwpPcGVu 
VlBOIENBMB4XDTA5MDMxODE4MjEzM1oXDTE5MDMxNjE4MjEzM1owITEfMB0GA1UE 
AxQWdGVzdEB3aW4yMDAzLnlvbmFuLm5ldDCBnzANBgkqhkiG9w0BAQEFAAOBjQAw 
gYkCgYEAr5X7alPPKB28GgxDAwr56BkEknfTnXEYgxqK9utltPkFlzyhs9NKQdmt 
fk8Tcr0uKqe46KTrkFziv6dDuu1xJif7Pza2uCLpN6D35HZKZJEZMMiX/BQtqrvr 
fHxCHEtpChy9eWSKpxgK+seFQP0VL7aUKQeowxg043wCR9g+ZRUCAwEAAaMgMB4w 
CQYDVR0TBAIwADARBglghkgBhvhCAQEEBAMCB4AwDQYJKoZIhvcNAQEFBQADgYEA 
BjwC31oDnZaf75NBn6ELmvrnZNsApdFwRSQtBcQ9R6TKOFRr4IUNevBk1jsyVm1T 
fLNQXUubSsrNU1K73y4wFs/8kHVDIUl2owkREM5XY5PvUWqj/Yb+W+2+hLjtqrIM 
bYDmFWuoZdH10+CKccvQqI53t0yUBpEfWnHQoioSdRA= 
-----END CERTIFICATE----- 
</cert> 

<key> 
-----BEGIN RSA PRIVATE KEY----- 
MIICXAIBAAKBgQDSElzGTRM0rs/6q/7L3ozxS0qVKGCHgiy4weWOxl0RWGGkpfFC 
14Z0bJ2cevA6XCnmUztebdjwRQYsI+4JvAKPDrjVMx/DShECSAvMS61udOCiU7HW 
zIm54m/bFbMZHlcEeUg62nYx/L/TNCHnMtieBk6+8+N5sFT90UIyqj56wQIDAQAB 
AoGBAK8RoIGekCfym99DYYfTg9A/t/tQeAnWYaDj7oSrKbqf1lgZ
91OGPEZgkoVr 
KzLnxf9uU+bhUs8CJx+4HdO8/L9rAJA+oD9QNuMp0elN4AKuEGE1Eq3a0e3cmgPI 
+VIoXM6WVAGgK9I03Zu/UerYQ/DdXWGOIsKhFe8qyQoG9pKxAkEA9ld6O9MHQt3d 
JAjJkgCNn4psozxjrfLWy2huXd3H3CRqGMjLITDGzdkVSgXjHokBYroi0+TZTu4M 
ulJSJaWwBQJBANpO2DAexH2zRHw5Z6QyeEVxz7B3/FzU4GgJx9BH+FSBh+F0G5Ln 
ir5Vst8vZ/LGcgpYjHQLNAvZVgUjiQ4Y6I0CQGvwMJL+CHR4GmmroAblTyjU0n1D 
/Lk/anZ+L73Za7U+D28ErFzCrpmLwRRKOBYtGfpUbOZDpCQ9kj4hy/TLALECQCcL 
9ysUNbzt9Y/qjJkX1d9F7gn4TBEmmkTBixW76bTjvjQbGlt6Qpyso2O8DPGlgPxM 
vkJ7RoHgC7y7kGYPGnkCQBVxSNGIjLx4NQBgN4HD0y4+fars1PTUGnckBcS4npb9 
onLNyerBlWdBwbARyBS7WPIbyyf5VCrn3yIqWxaARO0= 
-----END RSA PRIVATE KEY----- 
</key> 

key-direction 1 
<tls-auth> 
# 
# 2048 bit OpenVPN static key (Server Agent) 
# 
-----BEGIN OpenVPN Static key V1----- 
15ffe194eaa9ce6ba5ea80fed65491dd 
0aaa6706288256467122006538284177 
3b112097307af7c57cd93409fc92c693 
be90a056ae92c440b795e33b40e616d4 
868a75264ab91bdf6362a8265001eb7e 
cb0b79b96b81adf65c8cff52ab962ed6 
adc9309d5f46aade2644f264fdb864f0 
05be0f536d118cdd30564ba9727d006c 
4451ee8e0c8b33ee3a9e2595e68dc414 
63b742a444d9e4fa8ecf34eb9f887ee5 
308fecbfbf764b94ebd96f1c0b36fcfb 
816173ad30bb19253e18cc5af4c73060 
65c8414d2e28bc4bf779159ad616f50c 
79766ab9b17a9a2d1762f4b04049d87f 
d74c6aa6a7386c7a6d9fc46c543cd2dc 
6d2c0724b639556a6f3894b76101881e 
-----END OpenVPN Static key V1----- 
</tls-auth>
```