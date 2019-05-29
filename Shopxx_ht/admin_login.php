<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>管理中心 - Powered By SHOP++</title>
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta name="author" content="SHOP++ Team" />
    <meta name="copyright" content="SHOP++" />
    <link href="resources/admin/css/common.css" rel="stylesheet" type="text/css" />
    <link href="resources/admin/css/login.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="resources/admin/js/jquery.js"></script>
    <script type="text/javascript" src="resources/admin/js/jsbn.js"></script>
    <script type="text/javascript" src="resources/admin/js/prng4.js"></script>
    <script type="text/javascript" src="resources/admin/js/rng.js"></script>
    <script type="text/javascript" src="resources/admin/js/rsa.js"></script>
    <script type="text/javascript" src="resources/admin/js/base64.js"></script>
    <script type="text/javascript" src="resources/admin/js/common.js"></script>
    <script type="text/javascript">
//      $().ready( function() {
//
//          var $loginForm = $("#loginForm");
//          var $enPassword = $("#enPassword");
//          var $username = $("#username");
//          var $password = $("#password");
//          var $captcha = $("#captcha");
//          var $captchaImage = $("#captchaImage");
//          var $isRememberUsername = $("#isRememberUsername");
//
//          // 记住用户名
//          if(getCookie("adminUsername") != null) {
//              $isRememberUsername.prop("checked", true);
//              $username.val(getCookie("adminUsername"));
//              $password.focus();
//          } else {
//              $isRememberUsername.prop("checked", false);
//              $username.focus();
//          }
//
//          // 更换验证码
//          $captchaImage.click( function() {
//              $captchaImage.attr("src", "/admin/common/captcha.jhtml?captchaId=c9328e84-0a25-4411-b6c8-4d099bbd3b04&timestamp=" + (new Date()).valueOf());
//          });
//
//          // 表单验证、记住用户名
//          $loginForm.submit( function() {
//              if ($username.val() == "") {
//                  $.message("warn", "请输入您的用户名");
//                  return false;
//              }
//              if ($password.val() == "") {
//                  $.message("warn", "请输入您的密码");
//                  return false;
//              }
//              if ($captcha.val() == "") {
//                  $.message("warn", "请输入您的验证码");
//                  return false;
//              }
//
//              if ($isRememberUsername.prop("checked")) {
//                  addCookie("adminUsername", $username.val(), {expires: 7 * 24 * 60 * 60});
//              } else {
//                  removeCookie("adminUsername");
//              }
//
//              var rsaKey = new RSAKey();
//              rsaKey.setPublic(b64tohex("AI5CzH2itP5K03m88+YtQxjrsw+1qDCjZPKdcYTR10+yyvtjWm9kHhiUq+DYzOXTBYBnmbl+mdjnxyEgLnBCNz5iQhwvjiaB7S+M7KKt2+tKm3XJtie2q6AhSukDar0UGrgn/MIq/y/WCzWJASulES/sIDd29HyZYVWAe0lT+cA7"), b64tohex("AQAB"));
//              var enPassword = hex2b64(rsaKey.encrypt($password.val()));
//              $enPassword.val(enPassword);
//          });
//
//
//      });
    </script>

</head>
<body>


<!-- Copyright � 2005. Spidersoft Ltd -->
<style>
    A.applink:hover {border: 2px dotted #DCE6F4;padding:2px;background-color:#ffff00;color:green;text-decoration:none}
    A.applink       {border: 2px dotted #DCE6F4;padding:2px;color:#2F5BFF;background:transparent;text-decoration:none}
    A.info          {color:#2F5BFF;background:transparent;text-decoration:none}
    A.info:hover    {color:green;background:transparent;text-decoration:underline}
</style>
<div class="login">
    <form id="loginForm" action="../Shopxx_ht/service/admin_logincount.php" method="post">
        <input type="hidden" id="enPassword" name="enPassword" />

        <input type="hidden" name="captchaId" value="c9328e84-0a25-4411-b6c8-4d099bbd3b04" />

        <table>
            <tr>
                <td width="190" rowspan="2" align="center" valign="bottom">
                    <img src="resources/admin/images/login_logo.gif" alt="SHOP++" />
                </td>
                <th>
                    用户名:
                </th>
                <td>
                    <input type="text" id="username" name="uName" class="text" value="admin" maxlength="20" />
                </td>
            </tr>
            <tr>
                <th>
                    密&nbsp;&nbsp;&nbsp;码:
                </th>
                <td>
                    <input type="password" id="password" name="uPwd" class="text" value="admin" maxlength="20" autocomplete="off" />
                </td>
            </tr>



            <tr>
                <td>&nbsp;

                </td>
                <th>&nbsp;

                </th>
                <td>
                    <label>
                        <input type="checkbox" id="isRememberUsername" value="true" />
                        记住用户名
                    </label>
                </td>
            </tr>
            <tr>
                <td>&nbsp;

                </td>
                <th>&nbsp;

                </th>
                <td>
                    <input type="button" class="homeButton" value=""  /><input type="submit" class="loginButton" value="登录" />
                </td>
            </tr>
        </table>
        <div class="powered">COPYRIGHT © 2005-2019 SHOPXX.NET ALL RIGHTS RESERVED.</div>
        <div class="link">
            <a href="demo.shopxx.html">前台首页</a> |
            <a href="http://www.shopxx.net/">官方网站</a> |
            <a href="http://bbs.shopxx.net/">交流论坛</a> |
            <a href="http://www.shopxx.net/about.html">关于我们</a> |
            <a href="http://www.shopxx.net/contact.html">联系我们</a> |
            <a href="http://www.shopxx.net/license.html">授权查询</a>
        </div>
    </form>
</div>

</body>
</html>
