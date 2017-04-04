<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                 = 'front/c_front/index';
$route['DigiReservationAdministration']      = 'base/c_login';
$route['login/cek_login']                    = 'base/c_login/cek_login';
$route['login/logout']                       = 'base/c_login/logout';

$route['404_override']                       = '';
$route['translate_uri_dashes']               = FALSE;


$route['dashboard']                          = 'dashboard/c_dashboard';
$route['dashboard/reload_chart_lead']        = 'dashboard/c_dashboard/reload_chart_lead';
$route['dashboard/reload_chart_opportunity'] = 'dashboard/c_dashboard/reload_chart_opportunity';

$route['usergroup']                          = 'master/c_usergroup';
$route['usergroup/list']                     = 'master/c_usergroup/ajax_list';
$route['usergroup/create']                   = 'master/c_usergroup/create';
$route['usergroup/create_action']            = 'master/c_usergroup/create_action';
$route['usergroup/update_action']            = 'master/c_usergroup/update_action';
$route['usergroup/read/(:any)']              = 'master/c_usergroup/read/$1';
$route['usergroup/update/(:any)']            = 'master/c_usergroup/update/$1';
$route['usergroup/delete/(:any)']            = 'master/c_usergroup/delete/$1';

$route['user']                               = 'master/c_user';
$route['user/list']                          = 'master/c_user/ajax_list';
$route['user/create']                        = 'master/c_user/create';
$route['user/create_action']                 = 'master/c_user/create_action';
$route['user/update_action']                 = 'master/c_user/update_action';
$route['user/read/(:any)']                   = 'master/c_user/read/$1';
$route['user/update/(:any)']                 = 'master/c_user/update/$1';
$route['user/delete/(:any)']                 = 'master/c_user/delete/$1';

$route['staff']                              = 'master/c_staff';
$route['staff/list']                         = 'master/c_staff/ajax_list';
$route['staff/create']                       = 'master/c_staff/create';
$route['staff/create_action']                = 'master/c_staff/create_action';
$route['staff/update_action']                = 'master/c_staff/update_action';
$route['staff/read/(:any)']                  = 'master/c_staff/read/$1';
$route['staff/update/(:any)']                = 'master/c_staff/update/$1';
$route['staff/delete/(:any)']                = 'master/c_staff/delete/$1';

$route['service']                            = 'master/c_service';
$route['service/list']                       = 'master/c_service/ajax_list';
$route['service/create']                     = 'master/c_service/create';
$route['service/create_action']              = 'master/c_service/create_action';
$route['service/update_action']              = 'master/c_service/update_action';
$route['service/read/(:any)']                = 'master/c_service/read/$1';
$route['service/update/(:any)']              = 'master/c_service/update/$1';
$route['service/delete/(:any)']              = 'master/c_service/delete/$1';

$route['slide']                              = 'frontend/c_slide';
$route['slide/list']                         = 'frontend/c_slide/ajax_list';
$route['slide/create']                       = 'frontend/c_slide/create';
$route['slide/create_action']                = 'frontend/c_slide/create_action';
$route['slide/update_action']                = 'frontend/c_slide/update_action';
$route['slide/read/(:any)']                  = 'frontend/c_slide/read/$1';
$route['slide/update/(:any)']                = 'frontend/c_slide/update/$1';
$route['slide/delete/(:any)']                = 'frontend/c_slide/delete/$1';

$route['gallery']                            = 'frontend/c_gallery';
$route['gallery/list']                       = 'frontend/c_gallery/ajax_list';
$route['gallery/create']                     = 'frontend/c_gallery/create';
$route['gallery/create_action']              = 'frontend/c_gallery/create_action';
$route['gallery/update_action']              = 'frontend/c_gallery/update_action';
$route['gallery/read/(:any)']                = 'frontend/c_gallery/read/$1';
$route['gallery/update/(:any)']              = 'frontend/c_gallery/update/$1';
$route['gallery/delete/(:any)']              = 'frontend/c_gallery/delete/$1';

$route['product']                            = 'frontend/c_product';
$route['product/list']                       = 'frontend/c_product/ajax_list';
$route['product/create']                     = 'frontend/c_product/create';
$route['product/get_harga']                     = 'frontend/c_product/get_harga';
$route['product/create_action']              = 'frontend/c_product/create_action';
$route['product/update_action']              = 'frontend/c_product/update_action';
$route['product/read/(:any)']                = 'frontend/c_product/read/$1';
$route['product/update/(:any)']              = 'frontend/c_product/update/$1';
$route['product/delete/(:any)']              = 'frontend/c_product/delete/$1';

$route['promotion']                          = 'frontend/c_promotion';
$route['promotion/list']                     = 'frontend/c_promotion/ajax_list';
$route['promotion/create']                   = 'frontend/c_promotion/create';
$route['promotion/create_action']            = 'frontend/c_promotion/create_action';
$route['promotion/update_action']            = 'frontend/c_promotion/update_action';
$route['promotion/read/(:any)']              = 'frontend/c_promotion/read/$1';
$route['promotion/update/(:any)']            = 'frontend/c_promotion/update/$1';
$route['promotion/delete/(:any)']            = 'frontend/c_promotion/delete/$1';

$route['testimonial']                        = 'frontend/c_testimonial';
$route['testimonial/list']                   = 'frontend/c_testimonial/ajax_list';
$route['testimonial/create']                 = 'frontend/c_testimonial/create';
$route['testimonial/create_action']          = 'frontend/c_testimonial/create_action';
$route['testimonial/update_action']          = 'frontend/c_testimonial/update_action';
$route['testimonial/read/(:any)']            = 'frontend/c_testimonial/read/$1';
$route['testimonial/update/(:any)']          = 'frontend/c_testimonial/update/$1';
$route['testimonial/delete/(:any)']          = 'frontend/c_testimonial/delete/$1';

$route['creation']                           = 'frontend/c_creation';
$route['creation/list']                      = 'frontend/c_creation/ajax_list';
$route['creation/create']                    = 'frontend/c_creation/create';
$route['creation/create_action']             = 'frontend/c_creation/create_action';
$route['creation/update_action']             = 'frontend/c_creation/update_action';
$route['creation/read/(:any)']               = 'frontend/c_creation/read/$1';
$route['creation/update/(:any)']             = 'frontend/c_creation/update/$1';
$route['creation/delete/(:any)']             = 'frontend/c_creation/delete/$1';

$route['schedule']                           = 'frontend/c_schedule';
$route['schedule/list']                      = 'frontend/c_schedule/ajax_list';
$route['schedule/create']                    = 'frontend/c_schedule/create';
$route['schedule/create_action']             = 'frontend/c_schedule/create_action';
$route['schedule/update_action']             = 'frontend/c_schedule/update_action';
$route['schedule/read/(:any)']               = 'frontend/c_schedule/read/$1';
$route['schedule/update/(:any)']             = 'frontend/c_schedule/update/$1';
$route['schedule/delete/(:any)']             = 'frontend/c_schedule/delete/$1';

$route['reservation']                           = 'frontend/c_reservation';
$route['reservation/notifikasi']                = 'frontend/c_reservation/notifikasi';
$route['reservation/cek_konfirmasi']                = 'frontend/c_reservation/btn_konfirmasi';
$route['reservation/list']                      = 'frontend/c_reservation/ajax_list';
$route['reservation/create']                    = 'frontend/c_reservation/create';
$route['reservation/create_action']             = 'frontend/c_reservation/create_action';
$route['reservation/update_action']             = 'frontend/c_reservation/update_action';
$route['reservation/konfirmasi/(:any)']         = 'frontend/c_reservation/konfirmasi/$1';
$route['reservation/cencal/(:any)']         = 'frontend/c_reservation/cencal/$1';
$route['reservation/pending/(:any)']         = 'frontend/c_reservation/pending/$1';
$route['reservation/modal_konfirmasi/(:any)']         = 'frontend/c_reservation/modal_konfirmasi/$1';
$route['reservation/read/(:any)']               = 'frontend/c_reservation/read/$1';
$route['reservation/update/(:any)']             = 'frontend/c_reservation/update/$1';
$route['reservation/delete/(:any)']             = 'frontend/c_reservation/delete/$1';
$route['reservation/get_schedule']             = 'frontend/c_reservation/get_schedule';
$route['reservation/get_time_staff']             = 'frontend/c_reservation/get_time_staff';
$route['reservation/tab_waktu_product']             = 'frontend/c_reservation/tab_waktu_product';
$route['reservation/tab_biodata']             = 'frontend/c_reservation/tab_biodata';
$route['reservation/get_select_product']        = 'frontend/c_reservation/get_select_product';
$route['reservation/biodata']                   = 'frontend/c_reservation/biodata';

// front
$route['home']                                 = 'front/c_front/index';
$route['frontabout']                           = 'front/c_about/about';
$route['frontservice']                         = 'front/C_service_front/service';
$route['frontpromo']                           = 'front/c_promotion_front/promo';
$route['frontgallery']                         = 'front/c_gallery_front/gallery';
$route['testimonialfront']                = 'front/c_testimonial_front/testimonial';
$route['testimonialfront/detail2/(:any)'] = 'front/c_testimonial_front/detail/$1';
$route['frontservice/detail/(:any)']      = 'front/c_service_front/detail/$1';
$route['allgallery']                      = 'front/c_gallery_front/allgallery';
$route['frontpromotion/detail/(:any)']    = 'front/c_promotion_front/detail/$1';
$route['creation/detail/(:any)']      = 'front/c_creation_front/detail/$1';

$route['bookinglist']                        = 'front/c_reservation_front/bookinglist';
$route['reservation/list_front']             = 'frontend/c_reservation/ajax_list_front';
$route['contact']                            = 'front/C_contac_front/contact';

$route['frontreservation']                    = 'front/c_reservation_front/reservation';
$route['frontreservation/get_content_reservasi'] = 'front/c_reservation_front/get_content_reservasi';
$route['frontreservation/get_schedule']             = 'front/c_reservation_front/get_schedule';
$route['frontreservation/get_time_staff']        = 'front/c_reservation_front/get_time_staff';
$route['frontreservation/tab_biodata']        = 'front/c_reservation_front/tab_biodata';

$route['frontreservation/get_stapp1']        = 'front/c_reservation_front/get_stapp1';

$route['frontreservation/create_action']      = 'front/c_reservation_front/create_action';
$route['konfirmasi/payment/(:any)']           = 'front/c_reservation_front/payment/$1';
$route['konfirmasi']                          = 'front/c_reservation_front/konfirmasi';
$route['konfirmasi/savekonfirmasi']           = 'front/c_reservation_front/savekonfirmasi';
$route['konfirmasi/identitas']                ='front/c_reservation_front/identitas';
$route['konfirmasi/payment_methode/(:any)']   = 'front/c_reservation_front/payment_methode/$1';



$route['menu']                     = 'user-setting/c_menu';
$route['menu/list']                = 'user-setting/c_menu/ajax_list';
$route['menu/list_fitur']          = 'user-setting/c_menu/ajax_list_fitur';
$route['menu/create']              = 'user-setting/c_menu/create';
$route['menu/create_action']       = 'user-setting/c_menu/create_action';
$route['menu/update_action']       = 'user-setting/c_menu/update_action';
$route['menu/create_action_fitur'] = 'user-setting/c_menu/create_action_fitur';
$route['menu/update_action_fitur'] = 'user-setting/c_menu/update_action_fitur';
$route['menu/delete_fitur']        = 'user-setting/c_menu/delete_fitur';
$route['menu/read/(:any)']         = 'user-setting/c_menu/read/$1';
$route['menu/update/(:any)']       = 'user-setting/c_menu/update/$1';
$route['menu/fitur/(:any)']        = 'user-setting/c_menu/fitur/$1';
$route['menu/delete/(:any)']       = 'user-setting/c_menu/delete/$1';
$route['menu/cek_paten']           = 'user-setting/c_menu/cek_paten';

$route['akses']                    = 'user-setting/c_akses';
$route['akses/list']               = 'user-setting/c_akses/ajax_list';
$route['akses/create']             = 'user-setting/c_akses/create';
$route['akses/create_action']      = 'user-setting/c_akses/create_action';
$route['akses/update_action']      = 'user-setting/c_akses/update_action';
$route['akses/read/(:any)']        = 'user-setting/c_akses/read/$1';
$route['akses/update/(:any)']      = 'user-setting/c_akses/update/$1';
$route['akses/delete/(:any)']      = 'user-setting/c_akses/delete/$1';
$route['akses/content_listfitur']  = 'user-setting/c_akses/content_listfitur';
$route['akses/cek_paten']          = 'user-setting/c_akses/cek_paten';
