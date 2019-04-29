<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>
        <title><?php echo Html::encode(Yii::app()->settings->get('core', 'site_name')) ?>1231231</title>
        <style type="text/css">
            body {
                background: #EFEFEF;
                color: #555;
                font: normal normal normal 10pt/normal Arial, Helvetica, sans-serif;
                margin: 0px;
                padding: 0px;
            }

            #header {

                margin: 0px;
                padding: 0px;
            }

            #logo {
                font-size: 200%;
                padding: 10px 20px;
                text-align:center;
            }

            #page {
                width: 50%;
                background: white;
                -moz-box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.30);
                -webkit-box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.30);
                box-shadow: 0px 0px 5px rgba(50, 50, 50, 0.30);
                margin: 150px auto 0 auto;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }

            #message {
                text-align:center;
                padding: 20px;
                line-height: 25px;
            }


        </style>
    </head>
    <body>
        <div id="page">
            <div id="header">
                <div id="logo"><?php echo Html::encode(Yii::app()->settings->get('core', 'site_name')) ?></div>
            </div>
            <div id="message">


Ваш сайт сайт заработает через 15 минту.
            </div>
        </div>
    </body>
</html>