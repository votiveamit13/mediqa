

    {{-- <h1>{{ $mailData['subject'] }}</h1> --}}
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" name="mjqemailid" content="B0WB7P9VV27ACYA96DTTHDGYXR1I0SUB">

  <tbody>

    <tr>

      <td align="center" valign="top">

        <table border="0" cellpadding="10" cellspacing="0" width="100%" style="border:1px solid #ddd;margin:50px 0px 100px 0px;text-align:center;color:#363636;font-family:\'Montserrat\',Arial,Helvetica,sans-serif;background-color:white">

          <tbody>

            <tr>

              <td align="center" valign="top" style="padding:0px; background: #ffffff; border-bottom: 2px solid #ffffff;">

                <table border="0" cellpadding="0" cellspacing="10" width="100%">

                  <tbody>

                    <tr>

                      <td align="center" style="text-align: center;" valign="middle"><a style="font-family:\'Ubuntu\',sans-serif;color:#ff3000;font-weight:300;display:block;letter-spacing:-1.5px;text-decoration:none;margin-top:2px" href="#"><img src="{{ asset(env('LOGO_PATH') )}}" style="padding-top:0;display:inline-block;vertical-align:middle;margin-right:0px;height:55px" class="CToWUd"></a></td>

                    </tr>

                  </tbody>

                </table>

              </td>

            </tr>

            <tr>

              <td align="center" valign="top">

                <table border="0" cellpadding="0" cellspacing="10" width="100%">

                  <tbody>

                    <tr>

                      <td align="left" valign="top" style="color:#444;font-size:14px">

                        <?= $mailData['body'] ;?>

                        <p style="margin:0;padding:10px 0px">Thank You <br>Kind regards,<br>The {{ env('APP_NAME') }} Team</p>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </td>

            </tr>

            <tr>

              <td align="center" valign="top" style="background-color:#000000;color:white">

                <table border="0" cellpadding="0" cellspacing="10" width="100%">

                  <tbody>

                    <tr>

                      <td align="center" valign="top" width="80%">

                        <div style="margin:0;padding:0;color:#fff;font-size:13px">Copyright © <?=date("Y");?> <a href="#" style="color:white;text-decoration:none"> {{ env('APP_NAME') }} </a>. All rights reserved.</div>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </td>

            </tr>

          </tbody>

        </table>

      </td>

    </tr>

  </tbody>

</table>

