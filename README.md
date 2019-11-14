# TrustSec
TrustSec学生机 PHP sdk

$ts = new TrustSecClient(账户,密码);
        echo "获取设备列表\n";
//        print_r($ts->getDeviceList());

        echo "添加设备\n";
//        print_r($ts->addDevice('芒丁测试','18212341234'));

        echo "获取设备信息\n";
//        print_r($ts->getDeviceDetial('177948'));

        echo "修改设备信息\n";
//        print_r($ts->updateDeviceInfo('177948','芒丁测试88'));

        echo "获取亲情号码\n";
//        print_r($ts->getPhoneConfig('177948'));

        echo "修改设备亲情号码\n";
//        print_r($ts->setPhoneNumber('177948','18212341234,18212341234','18212341234'));


        echo "获取上课时间段\n";
//        print_r($ts->getClassTime('177948'));

        echo "设置上课时间段\n";
//        print_r($ts->setClassTime('177948','13:00','14:00','1234567'));

        echo "删除上课时间段\n";
//        print_r($ts->delClassTime('177948','234196'));


        echo "获取定位时间段\n";
//        print_r($ts->locReportList('177948'));

        echo "设置定位时间段\n";
//        print_r($ts->setLocReport('177948','13:00','14:00','1234567'));

        echo "删除定位时间段\n";
//        print_r($ts->delLocReport('177948','251092'));

        echo "同步激活数据\n";
//        print_r($ts->activePhone('177948'));
