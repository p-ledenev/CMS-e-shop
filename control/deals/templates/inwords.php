<?php
//������� �������� ���� � ����� ��������. ������� ����� (����������� ������ � ������ - ����� ��� �������, ������������ ����� - �������� ������), �� ������ � ������� - ����� ��������.
//���� ���������, denik@aport.ru  http://poligraf.h1.ru
function Number($c)
{
    $c = str_pad($c, 3, "0", STR_PAD_LEFT);
//---------�����
    switch ($c[0]) {
        case 0:
            $d[0] = "";
            break;
        case 1:
            $d[0] = "���";
            break;
        case 2:
            $d[0] = "������";
            break;
        case 3:
            $d[0] = "������";
            break;
        case 4:
            $d[0] = "���������";
            break;
        case 5:
            $d[0] = "�������";
            break;
        case 6:
            $d[0] = "��������";
            break;
        case 7:
            $d[0] = "�������";
            break;
        case 8:
            $d[0] = "���������";
            break;
        case 9:
            $d[0] = "���������";
            break;
    }
//--------------�������
    switch ($c[1]) {
        case 0:
            $d[1] = "";
            break;
        case 1:
        {
            $e = $c[1] . $c[2];
            switch ($e) {
                case 10:
                    $d[1] = "������";
                    break;
                case 11:
                    $d[1] = "�����������";
                    break;
                case 12:
                    $d[1] = "����������";
                    break;
                case 13:
                    $d[1] = "����������";
                    break;
                case 14:
                    $d[1] = "������������";
                    break;
                case 15:
                    $d[1] = "����������";
                    break;
                case 16:
                    $d[1] = "�����������";
                    break;
                case 17:
                    $d[1] = "����������";
                    break;
                case 18:
                    $d[1] = "������������";
                    break;
                case 19:
                    $d[1] = "������������";
                    break;
            };
        }
            break;
        case 2:
            $d[1] = "��������";
            break;
        case 3:
            $d[1] = "��������";
            break;
        case 4:
            $d[1] = "�����";
            break;
        case 5:
            $d[1] = "���������";
            break;
        case 6:
            $d[1] = "����������";
            break;
        case 7:
            $d[1] = "���������";
            break;
        case 8:
            $d[1] = "�����������";
            break;
        case 9:
            $d[1] = "���������";
            break;
    }
//--------------�������
    $d[2] = "";
    if ($c[1] != 1):
        switch ($c[2]) {
            case 0:
                $d[2] = "";
                break;
            case 1:
                $d[2] = "����";
                break;
            case 2:
                $d[2] = "���";
                break;
            case 3:
                $d[2] = "���";
                break;
            case 4:
                $d[2] = "������";
                break;
            case 5:
                $d[2] = "����";
                break;
            case 6:
                $d[2] = "�����";
                break;
            case 7:
                $d[2] = "����";
                break;
            case 8:
                $d[2] = "������";
                break;
            case 9:
                $d[2] = "������";
                break;
        }
    endif;

    return $d[0] . ' ' . $d[1] . ' ' . $d[2];

}

//---------------------------------------
function SumProp($sum)
{

// �������� �����
    $sum = str_replace(' ', '', $sum);
    $sum = trim($sum);
    if ((!(@eregi('^[0-9]*' . '[,\.]' . '[0-9]*$', $sum) || @eregi('^[0-9]+$', $sum))) || ($sum == '.') || ($sum == ',')) :
        return "��� �� ������: $sum";
    endif;
// ������ �������, ���� ��� ����, �� �����
    $sum = str_replace(',', '.', $sum);
    if ($sum >= 1000000000):
        return "������������ ����� &#151 ���� �������� ������ ����� ���� �������";
    endif;
// ��������� ������
    $rub = floor($sum);
    $kop = 100 * round($sum - $rub, 2);
    $kop .= " ���.";
    if (strlen($kop) == 6):
        $kop = "0" . $kop;
    endif;
    $kop = "";

// �������� ��������� ����� '�����'
    $one = substr($rub, -1);
    $two = substr($rub, -2);
    if ($two > 9 && $two < 21):
        $namerub = "������";
    elseif ($one == 1):
        $namerub = "�����";
    elseif ($one > 1 && $one < 5):
        $namerub = "�����";
    else:
        $namerub = "������";

    endif;
    if ($rub == "0"):
        return "���� ������ $kop";
    endif;
    $namerub = ""; //"���.";

//----------�����
    $sotni = substr($rub, -3);
    $nums = Number($sotni);
    if ($rub < 1000):
        return ucfirst(trim("$nums $namerub$kop"));
    endif;
//----------������
    if ($rub < 1000000):
        $ticha = substr(str_pad($rub, 6, "0", STR_PAD_LEFT), 0, 3);
    else:
        $ticha = substr($rub, strlen($rub) - 6, 3);
    endif;
    $one = substr($ticha, -1);
    $two = substr($ticha, -2);
    if ($two > 9 && $two < 21):

        $name1000 = " �����";
    elseif ($one == 1):

        $name1000 = " ������";
    elseif ($one > 1 && $one < 5):

        $name1000 = " ������";
    else:

        $name1000 = " �����";
    endif;
    $numt = Number($ticha);
    if ($one == 1 && $two != 11):
        $numt = str_replace('����', '����', $numt);
    endif;
    if ($one == 2):
        $numt = str_replace('���', '���', $numt);
        $numt = str_replace('����', '����', $numt);
    endif;
    if ($ticha != '000'):
        $numt .= $name1000;
    endif;
    if ($rub < 1000000):
        return ucfirst(trim("$numt $nums $namerub $kop"));
    endif;
//----------��������
    $million = substr(str_pad($rub, 9, "0", STR_PAD_LEFT), 0, 3);
    $one = substr($million, -1);
    $two = substr($million, -2);
    if ($two > 9 && $two < 21):

        $name1000000 = " ���������";
    elseif ($one == 1):

        $name1000000 = " �������";
    elseif ($one > 1 && $one < 5):

        $name1000000 = " ��������";
    else:

        $name1000000 = " ���������";
    endif;
    $numm = Number($million);
    $numm .= $name1000000;

    return ucfirst(trim("$numm $numt $nums $namerub $kop"));

}

?>