<head dir="rtl">
    <style type="text/css" title="x-apple-mail-formatting"></style>

    <meta name="viewport" content="width = 375, initial-scale = -1">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">

    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <style>

        /* -------------------------------------

        RESPONSIVENESS

        !importants in here are necessary :/

        ------------------------------------- */

        @media only screen and (max-device-width: 700px) {

            .table-wrapper {

                margin-top: 0px !important;

                border-radius: 0px !important;

            }


            .header {

                border-radius: 0px !important;

            }

        }

    </style>


</head>

<body
    style="-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;margin:0;padding:0;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;font-size:100%;line-height:1.6">

<table style="background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">

    <tbody>
    <tr>

        <td>

            <!-- body -->

            <table cellpadding="0" cellspacing="0" class="table-wrapper"
                   style="margin:auto;margin-top:50px;border-radius:7px;-webkit-border-radius:7px;-moz-border-radius:7px;max-width:700px !important;box-shadow:0 8px 20px #e3e7ea !important;-webkit-box-shadow:0 8px 20px #e3e7ea !important;-moz-box-shadow:0 8px 20px #e3e7ea !important;box-shadow: 0 8px 20px #e3e7ea !important; -webkit-box-shadow: 0 8px 20px #e3e7ea !important; -moz-box-shadow: 0 8px 20px #e3e7ea !important;">

                <tbody>

                <tr>

                    <td class="container content" bgcolor="#FFFFFF"
                        style="padding:35px 40px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;display:block !important;margin:0 auto !important;clear:both !important">

                        <!-- content -->

                        <div class="content-box" style="max-width:600px;margin:0 auto;display:block">

                            <!--

          Email template: myTeachable Confirmation Instructions (When No School is Set)

          Description: This email is sent when someone signs up or updates their email for a centralized Teachable Account.

           -->


                            <!-- Content -->

                            <h1 style="text-align: right;font-family:&quot;Rubik sans-serif&quot;, Rubik, Arial, &quot;Lucida Grande&quot;, sans-serif;margin-bottom:15px;color:#47505E;margin:0px 0 10px;line-height:1.2;font-weight:200;font-size:28px;font-weight:bold;margin-bottom:30px;">
                                آدرس ایمیل خود را تأیید کنید</h1>


                            <p style="direction:rtl;font-weight:normal;padding:0;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;float: right">
                                لطفاً برای تأیید آدرس ایمیل خود ، از کد زیر استفاده کنید</p>


                            <center><p  class="confirmation-url btn-primary"
                                       style="color:#1EA69A;word-wrap:break-word;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;text-decoration:none;background-color:#FF7F45;border:solid #FF7F45;line-height:2;max-width:100%;font-size:14px;padding:8px 40px 8px 40px;margin-top:30px;margin-bottom:30px;font-weight:bold;cursor:pointer;display:inline-block;border-radius:10px;margin-left:auto;margin-right:auto;text-align:center;color:#FFF !important">
                                    {{$code}}</p></center>


                            <p style="text-align: right;font-weight:normal;padding:0;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
                                با ارسال این کد حساب شما فعال میشود</p>


                            <p style="font-weight:normal;padding:0;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">
                                با آرزوی موفقیت<br>

                                تیم پشتیبان</p>


                            <!-- Auto-generated JSON-ld compliant JSON for showing action buttons in emails -->

                            <script type="application/ld+json">
                                {"@context":"http://schema.org","@type":"EmailMessage","potentialAction":{"@type":"ConfirmAction","name":"Confirm Email","handler":{"@type":"HttpActionHandler","url":"http://sso.teachable.com/secure/teachable_accounts/confirmation?confirmation_token=4dNuyAZNQin-Sfq48uB4"}}}
                            </script>


                        </div>

                        <!-- /content -->

                    </td>

                    <td>


                    </td>

                </tr>

                </tbody>
            </table>

            <!-- /body -->

            <div class="footer"
                 style="padding-top:30px;padding-bottom:55px;width:100%;text-align:center;clear:both !important">

                <p style="font-weight:normal;padding:0;font-family:&quot;Rubik sans-serif&quot;, &quot;Rubik&quot;, Rubik, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:12px;color:#666;margin-top:0px">
                    © Teachable Team™, <a href="https://weton.biz" dir="ltr" x-apple-data-detectors="true"
                                          x-apple-data-detectors-type="address" x-apple-data-detectors-result="0"
                                          style="color: rgb(102, 102, 102); -webkit-text-decoration-color: rgba(102, 102, 102, 0.258824);">https://weton.biz</a></p>

            </div>

        </td>

    </tr>

    </tbody>
</table>


</body>
{{--@component('vendor.mail.html.message')--}}
{{--#ایمیل فعالسازی--}}

{{--@component('vendor.mail.html.button' , ['url' => route('activation.account' , 'aaa')])--}}
{{--فعال سازی اکانت--}}
{{--@endcomponent--}}

{{--@endcomponent--}}
