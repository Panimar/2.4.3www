<?php
	/*---����� ���������---*/
	
	$project_name = 'WoW server';                        //��� �������
	$site_path = 'server.ru';                    //����� �������
	$site_realmlist = 'set realmlist logon.server.ru';     //��������� ������ �������
	$site_title = 'World of Warcraft - '.$project_name; //����� ����� �������
	$refresh_status_time = '10';                        //����� ���������� ���������� ������� (� ��������)
	$realm_count = '1';                                 //���-�� �������
	$page_count_online = '50';                          //���-�� ������� ������, ������������ �� ����� ��������
	$page_count_ban = '50';                             //���-�� ���������� ����������, ������������ �� ����� ��������
	$mysql_cod = 'cp1251';                              //��������� mysql �������
	$wmr = 'R---------';                             //�������
	$lang_count = '1';                                  //���-�� ������
	$lang_name['1'] = '�������';                        //�������� ������
	$lang_name['2'] = 'English';
	
	$mysql_path['cms'] = '127.0.0.1';                   //����� mysql �������
	$mysql_login['cms'] = 'root';                           //����� mysql �������
	$mysql_password['cms'] = 'root';                        //������ mysql �������
	$mysql_db['cms'] = 'rz_cms';                        //�������� ���� ���������
	
	/*---��������� ���� ������---*/
	/*---��������� ���� ������� ����������*/
	
	$mysql_path['1'] = '127.0.0.1';                     //����� mysql �������
	$mysql_login['1'] = 'root';                             //����� mysql �������
	$mysql_password['1'] = 'ascent';                          //������ mysql �������
	$mysql_db_characters['1'] = 'cha';           //�������� ���� ����������
	$mysql_db_realmd['1'] = 'realmd';                     //�������� ���� ���������
	$mysql_db_world['1'] = 'mangos';                     //�������� ���� ����
	$realm_title['1'] = '��������� ��� x100';                //�������� �������
	$mail_sender_guid['1'] = '1';                       //ID ���������, �� �������� ����� ���������� ������ � ����� �������. ���� �� �������, �� �� ������� ��� ����
	$server_path['1'] = '127.0.0.1';                    //����� �������
	$server_port['1'] = '3306';                         //���� ������� (8085 �� ���������)
	$server_type['1'] = '0';                            //��� �������. 0 - trinity core, 1 - myth core
	$lk_shop_f['1'] = 1;                                //��������� ���� � ��������. ��� ������ �1 ~ 3-4, ��� �100 ~ 15-20
	
	$mysql_path['2'] = '127.0.0.1';
	$mysql_login['2'] = 'root';
	$mysql_password['2'] = 'ascent';
	$mysql_db_characters['2'] = 'c';
	$mysql_db_realmd['2'] = 'realmd';
	$mysql_db_world['2'] = 'man';
	$realm_title['2'] = '�������� ���';
	$mail_sender_guid['2'] = '1';
	$server_path['2'] = '127.0.0.1';
	$server_port['2'] = '3306';
	$server_type['2'] = '0';
	$lk_shop_f['2'] = 4;
	
	
	/*---��������� ���-�� �����������---*/
	$vote_count = '2';                                  //���-�� �������� �����������
	$vote_bonuses = '25';                                //���-�� ������� �� �����
	
	$vote_link['1'] = 'http://wow.mmotop.ru/vote/0/';   //������ �� �����������
	$vote_name['1'] = 'wow.mmotop.ru';                  //�������� ����
	
	$vote_link['2'] = 'http://mwn-project.net/?do=vote&id=0';
	$vote_name['2'] = 'mwn-project.net';
?>