<?php
class Chinese
{
    /**
     * 存放 GB <-> UNICODE 对照表的内容
     * @变量类型
     * @起始      1.1
     * @最后修改  1.2
     * @访问      内部
     */
    var $unicode_table = array();

    /**
     * 访问中文繁简互换表的文件指针
     *
     * @变量类型  对象
     * @起始      1.0
     * @最后修改  1.0
     * @访问      内部
     */
    var $ctf;

    /**
     * 等待转换的字符串
     * @变量类型
     * @起始      1.0
     * @最后修改  1.0
     * @访问      内部
     */
    var $SourceText = '';

    /**
     * Chinese 的运行配置
     *
     * @变量类型  数组
     * @起始      1.0
     * @最后修改  1.2
     * @访问      公开
     */
    var $config = array(
        'codetable_dir'    => '',                // 存放各种语言互换表的目录
        'source_lang'      => '',                // 字符的原编码
        'target_lang'      => '',                // 转换后的编码
        'GBtoBIG5_table'   => 'gb-big5.table',   // 简体中文转换为繁体中文的对照表
        'BIG5toGB_table'   => 'big5-gb.table',   // 繁体中文转换为简体中文的对照表
        'GBtoUTF8_table'   => 'gb2312_utf8.php', // 简体中文转换为UTF-8的对照表
        'BIG5toUTF8_table' => 'big5_utf8.php'   // 繁体中文转换为UNICODE的对照表
    );

    /**
     * Chinese 的悉构函数
     *
     * 详细说明
     * @形参      字符串 $source_lang 为需要转换的字符串的原编码
     *            字符串 $target_lang 为转换的目标编码
     *            字符串 $SourceText 为等待转换的字符串
     *
     * @起始      1.0
     * @最后修改  1.2
     * @访问      公开
     * @返回值    无
     * @throws
     */
    function Chinese($dir = './')
    {
        $this->config['codetable_dir'] = $dir . "include/iconv/codetable/";
    }

    function Convert($source_lang, $target_lang, $source_string = '')
    {
        /* 如果编码相同，直接返回 */
        if ($source_lang == $target_lang || $source_string == '' || preg_match("/[\x80-\xFF]+/", $source_string) == 0)
        {
            return $source_string;
        }

        if ($source_lang != '')
        {
            $this->config['source_lang'] = $source_lang;
        }

        if ($target_lang != '')
        {
            $this->config['target_lang'] = $target_lang;
        }

        $this->SourceText = $source_string;

        $this->OpenTable();
        // 判断是否为中文繁、简转换
        if (($this->config['source_lang'] == 'GB2312' || $this->config['source_lang'] == 'BIG5') && ($this->config['target_lang'] == 'GB2312' || $this->config['target_lang'] == 'BIG5'))
        {
            return $this->GB2312toBIG5();
        }

        // 判断是否为简体、繁体中文与UTF8转换
        if (($this->config['source_lang'] == 'GB2312' || $this->config['source_lang'] == 'BIG5' || $this->config['source_lang'] == 'UTF8') && ($this->config['target_lang'] == 'UTF8' || $this->config['target_lang'] == 'GB2312' || $this->config['target_lang'] == 'BIG5'))
        {
            return $this->CHStoUTF8();
        }

        // 判断是否为简体、繁体中文与UNICODE转换
        if (($this->config['source_lang'] == 'GB2312' || $this->config['source_lang'] == 'BIG5') && $this->config['target_lang'] == 'UNICODE')
        {
            return $this->CHStoUNICODE();
        }
    }

    /**
     * 将 16 进制转换为 2 进制字符
     *
     * 详细说明
     * @形参      $hexdata 为16进制的编码
     * @起始      1.5
     * @最后修改  1.5
     * @访问      内部
     * @返回      字符串
     * @throws
     */
    function _hex2bin($hexdata)
    {
        $bindata = '';

        for ($i = 0, $count = strlen($hexdata); $i < $count; $i += 2)
        {
            $bindata .= chr(hexdec($hexdata{$i} . $hexdata{$i + 1}));
        }

        return $bindata;
    }

    /**
     * 打开对照表
     *
     * 详细说明
     * @形参
     * @起始      1.3
     * @最后修改  1.3
     * @访问      内部
     * @返回      无
     * @throws
     */
    function OpenTable()
    {
        static $gb2312_utf8_table = NULL;
        static $gb2312_unicode_table = NULL;
        static $utf8_gb2312_table = NULL;

        static $big5_utf8_table = NULL;
        static $big5_unicode_table = NULL;
        static $utf8_big5_table = NULL;

        // 假如原编码为简体中文的话
        if ($this->config['source_lang'] == 'GB2312')
        {
            // 假如转换目标编码为繁体中文的话
            if ($this->config['target_lang'] == 'BIG5')
            {
                $this->ctf = @fopen($this->config['codetable_dir'] . $this->config['GBtoBIG5_table'], 'rb');
                if (is_null($this->ctf))
                {
                    echo '打开打开转换表文件失败！';
                    exit;
                }
            }

            // 假如转换目标编码为 UTF8 的话
            if ($this->config['target_lang'] == 'UTF8')
            {
                if ($gb2312_utf8_table == NULL)
                {
                    require_once($this->config['codetable_dir'] . $this->config['GBtoUTF8_table']);
                }
                $this->unicode_table = $gb2312_utf8_table;
            }

            // 假如转换目标编码为 UNICODE 的话
            if ($this->config['target_lang'] == 'UNICODE')
            {
                if ($gb2312_unicode_table == NULL)
                {
                    if (isset($gb2312_utf8_table) === false)
                    {
                        require_once($this->config['codetable_dir'] . $this->config['GBtoUTF8_table']);
                    }
                    foreach ($gb2312_utf8_table AS $key => $value)
                    {
                        $gb2312_unicode_table[$key] = substr($value, 2);
                    }
                }
                $this->unicode_table = $gb2312_unicode_table;
            }
        }

        // 假如原编码为繁体中文的话
        if ($this->config['source_lang'] == 'BIG5')
        {
            // 假如转换目标编码为简体中文的话
            if ($this->config['target_lang'] == 'GB2312')
            {
                $this->ctf = @fopen($this->config['codetable_dir'] . $this->config['BIG5toGB_table'], 'r');
                if (is_null($this->ctf))
                {
                    echo '打开打开转换表文件失败！';
                    exit;
                }
            }
            // 假如转换目标编码为 UTF8 的话
            if ($this->config['target_lang'] == 'UTF8')
            {
                if ($big5_utf8_table == NULL)
                {
                    require_once($this->config['codetable_dir'] . $this->config['BIG5toUTF8_table']);
                }
                $this->unicode_table = $big5_utf8_table;
            }

            // 假如转换目标编码为 UNICODE 的话
            if ($this->config['target_lang'] == 'UNICODE')
            {
                if ($big5_unicode_table == NULL)
                {
                    if (isset($big5_utf8_table) === false)
                    {
                        require_once($this->config['codetable_dir'] . $this->config['BIG5toUTF8_table']);
                    }
                    foreach ($big5_utf8_table AS $key => $value)
                    {
                        $big5_unicode_table[$key] = substr($value, 2);
                    }
                }
                $this->unicode_table = $big5_unicode_table;
            }
        }

        // 假如原编码为 UTF8 的话
        if ($this->config['source_lang'] == 'UTF8')
        {
            // 假如转换目标编码为 GB2312 的话
            if ($this->config['target_lang'] == 'GB2312')
            {
                if ($utf8_gb2312_table == NULL)
                {
                    if (isset($gb2312_utf8_table) === false)
                    {
                        require_once($this->config['codetable_dir'] . $this->config['GBtoUTF8_table']);
                    }
                    foreach ($gb2312_utf8_table AS $key => $value)
                    {
                        $utf8_gb2312_table[hexdec($value)] = '0x' . dechex($key);
                    }
                }
                $this->unicode_table = $utf8_gb2312_table;
            }

            // 假如转换目标编码为 BIG5 的话
            if ($this->config['target_lang'] == 'BIG5')
            {
                if ($utf8_big5_table == NULL)
                {
                    if (isset($big5_utf8_table) === false)
                    {
                        require_once($this->config['codetable_dir'] . $this->config['BIG5toUTF8_table']);
                    }
                    foreach ($big5_utf8_table AS $key => $value)
                    {
                        $utf8_big5_table[hexdec($value)] = '0x' . dechex($key);
                    }
                }
                $this->unicode_table = $utf8_big5_table;
            }
        }
    }

    /**
     * 将简体、繁体中文的 UNICODE 编码转换为 UTF8 字符
     *
     * 详细说明
     * @形参      数字 $c 简体中文汉字的UNICODE编码的10进制
     * @起始      1.1
     * @最后修改  1.2
     * @访问      内部
     * @返回      字符串
     * @throws
     */
    function CHSUtoUTF8($c)
    {
        $str='';

        if ($c < 0x80)
        {
            $str .= $c;
        }
        elseif ($c < 0x800)
        {
            $str .= (0xC0 | $c >> 6);
            $str .= (0x80 | $c & 0x3F);
        }
        elseif ($c < 0x10000)
        {
            $str .= (0xE0 | $c >> 12);
            $str .= (0x80 | $c >> 6 & 0x3F);
            $str .= (0x80 | $c & 0x3F);
        }
        elseif ($c < 0x200000)
        {
            $str .= (0xF0 | $c >> 18);
            $str .= (0x80 | $c >> 12 & 0x3F);
            $str .= (0x80 | $c >> 6  & 0x3F);
            $str .= (0x80 | $c & 0x3F);
        }

        return $str;
    }

    /**
     * 简体、繁体中文 <-> UTF8 互相转换的函数
     *
     * 详细说明
     * @形参
     * @起始      1.1
     * @最后修改  1.5
     * @访问      内部
     * @返回      字符串
     * @throws
     */
    function CHStoUTF8()
    {
        if ($this->config['source_lang'] == 'BIG5' || $this->config['source_lang'] == 'GB2312')
        {
            $ret = '';

            while ($this->SourceText)
            {
                if (ord($this->SourceText{0}) > 127)
                {
                    if ($this->config['source_lang'] == 'BIG5')
                    {
                        $utf8 = $this->CHSUtoUTF8(hexdec(@$this->unicode_table[hexdec(bin2hex($this->SourceText{0} . $this->SourceText{1}))]));
                    }
                    if ($this->config['source_lang'] == 'GB2312')
                    {
                        $utf8 = $this->CHSUtoUTF8(hexdec(@$this->unicode_table[hexdec(bin2hex($this->SourceText{0} . $this->SourceText{1})) - 0x8080]));
                    }
                    for ($i = 0, $count = strlen($utf8); $i < $count; $i += 3)
                    {
                        $ret .= chr(substr($utf8, $i, 3));
                    }

                    $this->SourceText = substr($this->SourceText, 2, strlen($this->SourceText));
                }
                else
                {
                    $ret .= $this->SourceText{0};
                    $this->SourceText = substr($this->SourceText, 1, strlen($this->SourceText));
                }
            }
            $this->unicode_table = array();
            $this->SourceText = '';

            return $ret;
        }

        if ($this->config['source_lang'] == 'UTF8')
        {
            $i   = 0;
            $out = '';
            $len = strlen($this->SourceText);
            while ($i < $len)
            {
                $c = ord($this->SourceText{$i++});
                switch($c >> 4)
                {
                    case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
                        // 0xxxxxxx
                        $out .= $this->SourceText{$i - 1};
                        break;
                    case 12: case 13:
                        // 110x xxxx   10xx xxxx
                        $char2 = ord($this->SourceText{$i++});
                        $char3 = $this->unicode_table[(($c & 0x1F) << 6) | ($char2 & 0x3F)];

                        if ($this->config['target_lang'] == 'GB2312')
                        {
                            $out .= $this->_hex2bin(dechex($char3 + 0x8080));
                        }
                        elseif ($this->config['target_lang'] == 'BIG5')
                        {
                            $out .= $this->_hex2bin(dechex($char3 + 0x0000));
                        }
                        break;
                    case 14:
                        // 1110 xxxx  10xx xxxx  10xx xxxx
                        $char2 = ord($this->SourceText{$i++});
                        $char3 = ord($this->SourceText{$i++});
                        $char4 = @$this->unicode_table[(($c & 0x0F) << 12) | (($char2 & 0x3F) << 6) | (($char3 & 0x3F) << 0)];

                        if ($this->config['target_lang'] == 'GB2312')
                        {
                            $out .= $this->_hex2bin(dechex($char4 + 0x8080));
                        } elseif ($this->config['target_lang'] == 'BIG5')
                        {
                            $out .= $this->_hex2bin(dechex($char4 + 0x0000));
                        }

                        break;
                }
            }

            // 返回结果
            return $out;
        }
    }

    /**
     * 简体、繁体中文转换为 UNICODE编码
     *
     * 详细说明
     * @形参
     * @起始      1.2
     * @最后修改  1.2
     * @访问      内部
     * @返回      字符串
     * @throws
     */
    function CHStoUNICODE()
    {
        $utf = '';

        while ($this->SourceText)
        {
            if (ord($this->SourceText{0}) > 127)
            {
                if ($this->config['source_lang'] == 'GB2312')
                {
                    $utf .= '&#x' . $this->unicode_table[hexdec(bin2hex($this->SourceText{0} . $this->SourceText{1})) - 0x8080] . ';';
                }
                elseif ($this->config['source_lang'] == 'BIG5')
                {
                    $utf .= '&#x' . $this->unicode_table[hexdec(bin2hex($this->SourceText{0} . $this->SourceText{1}))] . ';';
                }

                $this->SourceText = substr($this->SourceText, 2, strlen($this->SourceText));
            }
            else
            {
                $utf .= $this->SourceText{0};
                $this->SourceText = substr($this->SourceText, 1, strlen($this->SourceText));
            }
        }

        return $utf;
    }

    /**
     * 简体中文 <-> 繁体中文 互相转换的函数
     *
     * 详细说明
     * @起始      1.0
     * @访问      内部
     * @返回值    经过编码的utf8字符
     * @throws
     */
    function GB2312toBIG5()
    {
        // 获取等待转换的字符串的总长度
        $max = strlen($this->SourceText) - 1;

        for ($i = 0; $i < $max; $i++)
        {
            $h = ord($this->SourceText[$i]);
            if ($h >= 160)
            {
                $l = ord($this->SourceText[$i+1]);

                if ($h == 161 && $l == 64)
                {
                    $gb = '  ';
                }
                else
                {
                    fseek($this->ctf, ($h-160) * 510 + ($l - 1) * 2);
                    $gb = fread($this->ctf, 2);
                }

                $this->SourceText[$i] = $gb[0];
                $this->SourceText[$i+1] = $gb[1];

                $i++;
            }
        }
        fclose($this->ctf);

        // 将转换后的结果赋予 $result;
        $result = $this->SourceText;

        // 清空 $thisSourceText
        $this->SourceText = '';

        // 返回转换结果
        return $result;
    }
}

?>