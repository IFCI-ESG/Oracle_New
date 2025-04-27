<!DOCTYPE html>
<html>
<style>
    h1, h2, h3, h4, h5, h6 {
        text-align: center;
    }
    #t01,#t02,#t03 {
        border: 1px solid black;
}
#t03 {
  text-align: center;
}
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Account Created!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
    <table style="width: 100%">
        <tr>
            <td style="padding: 10px 0 20px 0;">
                <table style="border: 1px solid #cccccc; border-collapse: collapse; width:800px;">
                    <tr>
                        <td style=" color: #153643; font-size: 24px; font-weight: bold; font-family: Arial, sans-serif; background-color:#A9CCE3;text-justify-center">
                            <h2>Welcome to IFCI ESG PRAKRIT</h2>
                        </td>
                    </tr>
                    <tr>
                        <td   style="padding: 40px 30px 40px 30px; background-color:#ffffff;">
                            <table  style="width : 100%;">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                                        <p>Dear {{$name}},</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: justify;">
                                        <P>
                                            Thank you for registering with <b>ESG-PRAKRIT</b>! We're excited to have you on board
                                        </P>
                                        <p>
                                            To get started, please use the following credentials to access the platform:<br>
                                            <b>Username:</b> {{$unique_id}}<br>
                                            <b>Password:</b> {{$password}}<br>
                                        </p>
                                        <p>
                                            You can access the platform by clicking  https://esg.ifciltd.com/
                                        </p>
                                        <p>
                                            We encourage you to explore the platform and familiarize yourself with its features. We're confident that ESG-PRAKRIT will be a valuable asset in streamlining your ESG & sustainability journey.
                                        </p>
                                        <p>
                                            If you encounter any issues please don't hesitate to contact us at <b>Email Address</b> or call us at XXXXXXXXX Our team is ready to assist you.
                                        </p>
                                        <p>
                                            We look forward to a successful partnership!
                                        </p>
                                        <p>
                                            Please Do Not Reply This Mail.
                                        </p>
                                        <p>
                                            Regards<br>
                                            {{$bank_name}}
                                        </p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        {{-- <img src="../asset/images/logo/email_logo.png" alt=""> --}}
                                        {{-- <img src="{{ asset('images/logo/email_logo.png') }}" alt="Company Logo"> --}}
                                        <img src="cid:email_logo" alt="Company Logo" width="800">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td  style="padding: 0px 30px 0px 30px; background-color:#ee4c50; ">
                            <table style="width: 100%">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;width: 75%;">
                                        <h4>@ ESG - PRAKRIT  2025</h4>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>


