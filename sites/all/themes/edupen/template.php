<?php
function getMainMenu()
{
  if(ktra_menu()==1)
  {
    return getMainMenuUser();
  }
  else
  {
    return getMainChinh();
  }
}
function ktra_menu()
{
  if(arg(1)=='136'||
    arg(1)!='login' ||
    arg(0)=='quan-ly-de-thi'||
    arg(1)=='137'||
    arg(1)=='138')
  {
    return 1;
  }
  else
  {
    return 0;
  }
}
function getMainChinh()
{
  $mainMenu = menu_tree_all_data('main-menu');
  $str = "";

  foreach ($mainMenu as $item) {
    if ($item['link']['hidden'] == 0) {
      // Nếu không có menu con
      if (count($item['below']) == 0) {
        $str .= '<li>';
        $str .= l(
          '<span class="text">' . $item['link']['title'] . '</span>',
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array('')
            ),
            'html' => true
          )
        );
      } else {
        $str .= '<li class="dropdown-submenu dropend">';
        $str .= l(
          $item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array(' dropdown-item dropdown-toggle'),
            ),
            'html' => true,
          )
        );
      }
      // nếu có menu con
      if (count($item['below']) > 0) {
        $str .= '<ul class="dropdown-menu">';
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0) {
            if (count($subItem['below']) == 0) {
              $str .= '<li>' . l(
                  $subItem['link']['link_title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],

                    ),
                    'html' => true,
                  )
                ) . '</li>';
            } else {
              $str .= '<li class="dropdown-submenu dropend">' . l(
                  $subItem['link']['link_title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],
                      'class' => array(' dropdown-item dropdown-toggle'),

                    ),
                    'html' => true,
                  )
                );
            }
            if (count($subItem['below']) > 0) {
              $str .= '<ul class="dropdown-menu">';
              foreach ($subItem['below'] as $childItem) {
                if ($childItem['link']['hidden'] == 0) {
                  if (count($childItem['below']) == 0) {
                    $str .= '<li>' . l(
                        $childItem['link']['link_title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                          ),
                          'html' => true,
                        )
                      ) . '</li>';
                  } else {
                    $str .= '<li class="dropdown-submenu">' . l(
                        $childItem['link']['link_title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                            'class' => array(' dropdown-item dropdown-toggle'),

                          ),
                          'html' => true,
                        )
                      );
                    if (count($childItem['below']) > 0) {
                      $str .= '<ul class="dropdown-menu">';
                      foreach ($childItem['below'] as $item1) {
                        if ($item1['link']['hidden'] == 0) {
                          if (count($item1['below']) == 0) {
                            $str .= '<li>' . l(
                                $item1['link']['link_title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                  ),
                                  'html' => true,
                                )
                              ) . '</li>';
                          } else {
                            $str .= '<li class="dropdown-submenu">' . l(
                                $item1['link']['link_title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                    'class' => array(' dropdown-item dropdown-toggle'),

                                  ),
                                  'html' => true,
                                )
                              );
                          }
                          if (count($item1['below']) > 0) {
                            $str .= '<ul class="dropdown-menu">';
                            foreach ($item1['below'] as $item2){
                              if ($item2['link']['hidden'] == 0){
                                if (count($item2['below'])==0){
                                  $str .= '<li>' . l(
                                      $item1['link']['link_title'],
                                      $item1['link']['link_path'],
                                      array(
                                        'attributes' => array(
                                          'title' => $item1['link']['link_title'],
                                        ),
                                        'html' => true,
                                      )
                                    ) . '</li>';
                                }
                              }
                            }
                            $str .= '</ul>';
                          }
                          $str .= '</li>';
                        }
                      }
                      $str .= '</ul>';

                    }
                  }
                  $str .= '</li>';
                }
              }
              $str .= '</ul>';
              $str .= '</li>';
            }
          }
        }
        $str .= '</ul>';
      }
      $str .= '</li>';
    }
  }
  return '<ul class="dashboard-nav__menu-list">' . $str . '</ul>';
}
function get_breadcrumb()
{
  $mainMenu = menu_tree_all_data('main-menu');
  $str = "";
  $array=array();
  foreach ($mainMenu as $item) {
    $str = "";
    if ($item['link']['hidden'] == 0) {
      // Nếu không có menu con
      if (count($item['below']) == 0) {
        $ds_term=explode('/',$item['link']['link_path']);
        $id_term=$ds_term[2];
        $str_1 = $str.'<span class="text">'.l(
            $item['link']['title'],
            $item['link']['link_path'],
            array(
              'attributes' => array(
                'title' => $item['link']['link_title'],
                'class' => array('')
              ),
              'html' => true
            )
          ).'</span>'; $array[trim($id_term)]=$str_1;

      } else {
        $ds_term=explode('/',$item['link']['link_path']);
        $id_term=$ds_term[2];
        $str_1 = $str.'<span class="text">'.l(
            $item['link']['title'],
            $item['link']['link_path'],
            array(
              'attributes' => array(
                'title' => $item['link']['link_title'],
                'class' => array('')
              ),
              'html' => true
            )
          ).'</span>'; $array[trim($id_term)]=$str_1;
      }
      // nếu có menu con
      if (count($item['below']) > 0) {
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0) {
            if (count($subItem['below']) == 0) {
              $ds_term=explode('/',$subItem['link']['link_path']);
              $id_term=$ds_term[2];
              $str_2 = $str_1.'»<span class="text">'.l(
                  $subItem['link']['title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],
                      'class' => array('')
                    ),
                    'html' => true
                  )
                ).'</span>'; $array[trim($id_term)]=$str_2;
            } else {
              $str_2 = $str_1.'»<span class="text">'.l(
                  $subItem['link']['title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],
                      'class' => array('')
                    ),
                    'html' => true
                  )
                ).'</span>'; $array[trim($id_term)]=$str_2;
            }
            if (count($subItem['below']) > 0) {
              foreach ($subItem['below'] as $childItem) {
                if ($childItem['link']['hidden'] == 0) {
                  if (count($childItem['below']) == 0) {
                    $ds_term=explode('/',$childItem['link']['link_path']);
                    $id_term=$ds_term[2];
                    $str_3 = $str_2.'»<span class="text">'.l(
                        $childItem['link']['title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                            'class' => array('')
                          ),
                          'html' => true
                        )
                      ).'</span>'; $array[trim($id_term)]=$str_3;
                  } else {
                    $ds_term=explode('/',$childItem['link']['link_path']);
                    $id_term=$ds_term[2];
                    $str_3 = $str_2.'»<span class="text">'.l(
                        $childItem['link']['title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                            'class' => array('')
                          ),
                          'html' => true
                        )
                      ).'</span>'; $array[trim($id_term)]=$str_3;
                    if (count($childItem['below']) > 0) {
                      foreach ($childItem['below'] as $item1) {
                        if ($item1['link']['hidden'] == 0) {
                          if (count($item1['below']) == 0) {
                            $ds_term=explode('/',$item1['link']['link_path']);
                            $id_term=$ds_term[2];
                            $str_4 = $str_3.'»<span class="text">'.l(
                                $item1['link']['title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                    'class' => array('')
                                  ),
                                  'html' => true
                                )
                              ).'</span>'; $array[trim($id_term)]=$str_4;
                          } else {
                            $ds_term=explode('/',$item1['link']['link_path']);
                            $id_term=$ds_term[2];
                            $str_4 = $str_3.'»<span class="text">'.l(
                                $item1['link']['title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                    'class' => array('')
                                  ),
                                  'html' => true
                                )
                              ).'</span>'; $array[trim($id_term)]=$str_4;
                          }
                          if (count($item1['below']) > 0) {
                            foreach ($item1['below'] as $item2){
                              if ($item2['link']['hidden'] == 0){
                                if (count($item2['below'])==0){
                                  $ds_term=explode('/',$item2['link']['link_path']);
                                  $id_term=$ds_term[2];
                                  $str_5 = $str_4.'»<span class="text">'.l(
                                      $item2['link']['title'],
                                      $item2['link']['link_path'],
                                      array(
                                        'attributes' => array(
                                          'title' => $item2['link']['link_title'],
                                          'class' => array('')
                                        ),
                                        'html' => true
                                      )
                                    ).'</span>'; $array[trim($id_term)]=$str_5;
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  return $array;
}
function getMainMenuUser()
{
  $mainMenu = menu_tree_all_data('menu-menu-user');
  $str = "";
  global $user;
  foreach ($mainMenu as $item) {
    if ($item['link']['hidden'] == 0) {
      // Nếu không có menu con
      if (count($item['below']) == 0) {
        if($item['link']['title']=='Chỉnh sửa thông tin')
        {
          $str .= '<li>';
          $icon='';
          if(isset($item['link']['options']['attributes']['title']))
          {
            $icon=$item['link']['options']['attributes']['title'];
          }
          $link_need='/';
          if(isset($user->uid)&&($user->uid!=0))
          {
            $link_need='user/'.$user->uid.'/edit';
          }
          $str .= l(
            $icon.'<span class="text">' . $item['link']['title'] . '</span>',
            $link_need,
            array(
              'attributes' => array(
                'title' => $item['link']['link_title'],
                'class' => array('')
              ),
              'html' => true
            )
          );
        }
        else
        {
          $str .= '<li>';
          $icon='';
          if(isset($item['link']['options']['attributes']['title']))
          {
            $icon=$item['link']['options']['attributes']['title'];
          }
          $str .= l(
            $icon.'<span class="text">' . $item['link']['title'] . '</span>',
            $item['link']['link_path'],
            array(
              'attributes' => array(
                'title' => $item['link']['link_title'],
                'class' => array('')
              ),
              'html' => true
            )
          );
        }
      } else {
        $str .= '<li class="dropdown-submenu dropend">';
        $str .= l(
          $item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array(' dropdown-item dropdown-toggle'),
            ),
            'html' => true,
          )
        );
      }

      // nếu có menu con
      if (count($item['below']) > 0) {
        $str .= '<ul class="dropdown-menu">';
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0) {
            if (count($subItem['below']) == 0) {
              $str .= '<li>' . l(
                  $subItem['link']['link_title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],

                    ),
                    'html' => true,
                  )
                ) . '</li>';
            } else {
              $str .= '<li class="dropdown-submenu dropend">' . l(
                  $subItem['link']['link_title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],
                      'class' => array(' dropdown-item dropdown-toggle'),

                    ),
                    'html' => true,
                  )
                );
            }
            if (count($subItem['below']) > 0) {
              $str .= '<ul class="dropdown-menu">';
              foreach ($subItem['below'] as $childItem) {
                if ($childItem['link']['hidden'] == 0) {
                  if (count($childItem['below']) == 0) {
                    $str .= '<li>' . l(
                        $childItem['link']['link_title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                          ),
                          'html' => true,
                        )
                      ) . '</li>';
                  } else {
                    $str .= '<li class="dropdown-submenu">' . l(
                        $childItem['link']['link_title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                            'class' => array(' dropdown-item dropdown-toggle'),

                          ),
                          'html' => true,
                        )
                      );
                    if (count($childItem['below']) > 0) {
                      $str .= '<ul class="dropdown-menu">';
                      foreach ($childItem['below'] as $item1) {
                        if ($item1['link']['hidden'] == 0) {
                          if (count($item1['below']) == 0) {
                            $str .= '<li>' . l(
                                $item1['link']['link_title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                  ),
                                  'html' => true,
                                )
                              ) . '</li>';
                          } else {
                            $str .= '<li class="dropdown-submenu">' . l(
                                $item1['link']['link_title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                    'class' => array(' dropdown-item dropdown-toggle'),

                                  ),
                                  'html' => true,
                                )
                              );
                          }
                          if (count($item1['below']) > 0) {
                            $str .= '<ul class="dropdown-menu">';
                            foreach ($item1['below'] as $item2){
                              if ($item2['link']['hidden'] == 0){
                                if (count($item2['below'])==0){
                                  $str .= '<li>' . l(
                                      $item1['link']['link_title'],
                                      $item1['link']['link_path'],
                                      array(
                                        'attributes' => array(
                                          'title' => $item1['link']['link_title'],
                                        ),
                                        'html' => true,
                                      )
                                    ) . '</li>';
                                }
                              }
                            }
                            $str .= '</ul>';
                          }
                          $str .= '</li>';
                        }
                      }
                      $str .= '</ul>';

                    }
                  }
                  $str .= '</li>';
                }
              }
              $str .= '</ul>';
              $str .= '</li>';
            }
          }
        }
        $str .= '</ul>';
      }
      $str .= '</li>';
    }
  }
  return '<ul class="dashboard-nav__menu-list menu_user">' . $str . '</ul>';
}
function getMainMenuAssignment()
{
  $mainMenu = menu_tree_all_data('main-menu');
  $str = "";
  $run_1 = 0;
  foreach ($mainMenu as $item) {
    if ($item['link']['hidden'] == 0) {
      // Nếu không có menu con
      $run_1++;
      if($run_1>3)
      {
        break;
      }
      if (count($item['below']) == 0) {
        $str .= "<li>";
        $str .= l(
          $item['link']['title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array('')
            ),
            'html' => true
          )
        );
      } else {
        $str .= '<li  class="sub-menu-down">';
        $str .= l(
          $item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array('') ,
            ),
            'html' => true,
          )
        );
      }

      // nếu có menu con
      if (count($item['below']) > 0) {
        $str .= '<ul class="sub-menu">';
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0) {
            $str .=  '<li>'.l(
                $subItem['link']['link_title'],
                $subItem['link']['link_path'],
                array(
                  'attributes' => array(
                    'title' => $subItem['link']['link_title'],
                    'class' => array("text-capitalize")
                  ),
                  'html' => true,
                )
              ) ;
            $str.='</li>';
          }
        }
        $str .= '</ul>';
      }
      $str .= '</li>';
    }
  }

  $str= '<ul class="menu-primary__container">' . $str . '</ul>';
  return $str;
}
function getMainMenuDocument()
{
  $mainMenu = menu_tree_all_data('main-menu');
  $str = "";

  foreach ($mainMenu as $item) {
    if ($item['link']['hidden'] == 0) {
      // Nếu không có menu con
      if (count($item['below']) == 0) {
        $str .= '<li>';
        $str .= l(
          $item['link']['title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
            ),
            'html' => true
          )
        );
      } else {
        $str .= '<li>';
        $str .= l(
          $item['link']['link_title'].'<span class="toggle-sub-menu"></span>',
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array(''),
            ),
            'html' => true,
          )
        );
      }

      // nếu có menu con
      if (count($item['below']) > 0) {
        $str .= '<ul class="sub-categories children">';
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0) {
            if (count($subItem['below']) == 0) {
              $str .= '<li>' . l(
                  $subItem['link']['link_title'],
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],

                    ),
                    'html' => true,
                  )
                ) . '</li>';
            } else {
              $str .= '<li>' . l(
                  $subItem['link']['link_title'].'<span class="toggle-sub-menu"></span>',
                  $subItem['link']['link_path'],
                  array(
                    'attributes' => array(
                      'title' => $subItem['link']['link_title'],
                      'class' => array(''),

                    ),
                    'html' => true,
                  )
                );
            }
            if (count($subItem['below']) > 0) {
              $str .= '<ul class="sub-categories children">';
              foreach ($subItem['below'] as $childItem) {
                if ($childItem['link']['hidden'] == 0) {
                  if (count($childItem['below']) == 0) {
                    $str .= '<li>' . l(
                        $childItem['link']['link_title'],
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                          ),
                          'html' => true,
                        )
                      ) . '</li>';
                  } else {
                    $str .= '<li>' . l(
                        $childItem['link']['link_title'].'<span class="toggle-sub-menu"></span>',
                        $childItem['link']['link_path'],
                        array(
                          'attributes' => array(
                            'title' => $childItem['link']['link_title'],
                            'class' => array(''),

                          ),
                          'html' => true,
                        )
                      );
                    if (count($childItem['below']) > 0) {
                      $str .= '<ul class="course-list children">';
                      foreach ($childItem['below'] as $item1) {
                        if ($item1['link']['hidden'] == 0) {
                          if (count($item1['below']) == 0) {
                            $str .= '<li>' . l(
                                $item1['link']['link_title'],
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                  ),
                                  'html' => true,
                                )
                              ) . '</li>';
                          } else {
                            $str .= '<li >' . l(
                                $item1['link']['link_title'].'<span class="toggle-sub-menu"></span>',
                                $item1['link']['link_path'],
                                array(
                                  'attributes' => array(
                                    'title' => $item1['link']['link_title'],
                                    'class' => array(''),

                                  ),
                                  'html' => true,
                                )
                              );
                          }
                          if (count($item1['below']) > 0) {
                            $str .= '<ul class="course-list children">';
                            foreach ($item1['below'] as $item2){
                              if ($item2['link']['hidden'] == 0){
                                if (count($item2['below'])==0){
                                  $str .= '<li>' . l(
                                      $item1['link']['link_title'],
                                      $item1['link']['link_path'],
                                      array(
                                        'attributes' => array(
                                          'title' => $item1['link']['link_title'],
                                        ),
                                        'html' => true,
                                      )
                                    ) . '</li>';
                                }
                              }
                            }
                            $str .= '</ul>';
                          }
                          $str .= '</li>';
                        }
                      }
                      $str .= '</ul>';

                    }
                  }
                  $str .= '</li>';
                }
              }
              $str .= '</ul>';
              $str .= '</li>';
            }
          }
        }
        $str .= '</ul>';
      }
      $str .= '</li>';
    }
  }
  return '<ul class="header-category-dropdown">' . $str . '</ul>';
}

/**
 * Implements hook_form_alter().
 */

function getUserMenu()
{
  $mainMenu = menu_tree_all_data('menu-user-menu');
  $str = "";
  foreach ($mainMenu as $item) {

    if ($item['link']['hidden'] == 0) {
      //       neu ko co menu con
      if (count($item['below']) == 0) {

        $str .= "<li>";
        $str .= l(
          '<span class="text">'.$item['link']['link_title'].'</span>',
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title'],
              'class' => array('nav-link'),
            ),
            'html' => true

          )
        );
      } else {
        $str .= ' <li class="nav-link">';
        $str .= l($item['link']['link_title'],
          $item['link']['link_path'],
          array(
            'attributes' => array(
              'title' => $item['link']['link_title']
            ),
            'html' => true
          )
        );
      }

      /*neu co menu con*/

      if (count($item['below']) > 0) {
        $str .= '<ul class="submenu dropdown-menu">';
        foreach ($item['below'] as $subItem) {
          if ($subItem['link']['hidden'] == 0)
            $str .= "<li>" . l($subItem['link']['link_title'],
                $subItem['link']['link_path'],
                array(
                  'attributes' => array(
                    'title' => $item['link']['link_title']
                  )
                )
              ) . "</li>";
        }
        $str .= '</ul>';
      }
      $str .= '</li>';
    }
  }

  return '<ul class="dashboard-nav__menu-list" >' . $str . '</ul>';
}

/**
 * Implements hook_form_alter().
 */

function edupen_preprocess_page(&$variables) {
  if (isset($variables['node']->type)) {
    $nodetype = $variables['node']->type;
    $variables['theme_hook_suggestions'][] = 'page__' . $nodetype;
  }
}

/**
 * Implements hook_form_alter().
 */
function edupen_form_de_thi_node_form_alter(&$form, &$form_state, $form_id)
{
  $form['#prefix'] = t('<div class="form-de-thi">');
  $form['#suffix'] = t('</div>');
  $form['field_dap_an_dung']['#suffix'] = t('<div class="row"><div class="col-md-4 offset-md-4"><div class="js-multiple"></div></div></div>');
  $form['title']['#title'] = t('Tiêu đề');
  $form['title']['#attributes']['class'] = array('form-control');
  $form['field_phi']['und'][0]['value']['#attributes']['class'] = array('form-control');
}

/**
 * Implements hook_user_login().
 */
function strlogin()
{
  global $user;
  $str_new='';
  if(isset($user) && $user->uid!='' && $user->uid!=0)
  {
    $str_new='<div class="ml-15"><a href="/user/logout" class="icon_logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></div>';
  }
  $str_new='';
  return $str_new;
}
function edupen_form_alter(&$form, $form_state, $form_id) {
  if($form_id=='de_thi_node_form')
  {
    $form['field_tep_de_thi']['#prefix']='<div class="row"><div class="col-md-6">';
    $form['field_tep_de_thi']['#suffix']='</div>';
    $form['field_tep_loi_giai']['#prefix']='<div class="col-md-6">';
    $form['field_tep_loi_giai']['#suffix']='</div></div>';

    $form['title']['#prefix']='<div class="row"><div class="col-md-6">';
    $form['title']['#suffix']='</div>';
    $form['field_danh_muc']['#theme_wrappers'] = array();
    $form['field_danh_muc']['und']['#prefix']='<div class="col-md-6">';
    $form['field_danh_muc']['und']['#suffix']='</div></div>';

    $form['field_so_cau_hoi']['#theme_wrappers'] = array();
    $form['field_so_cau_hoi']['#prefix']='<div class="col-md-4">';
    $form['field_so_cau_hoi']['#suffix']='<div class="col-md-4"></div></div>';
    $form['field_thoi_gian_thi']['#theme_wrappers'] = array();
    $form['field_thoi_gian_thi']['#prefix']='<div class="col-md-4">';
    $form['field_thoi_gian_thi']['#suffix']='</div></div>';
    $form['product_catalog']['#theme_wrappers'] = array();
    $form['product_catalog']['#prefix']='<div class="danh_muc_catalog tontai">';
    $form['product_catalog']['#suffix']='</div>';
    $form['field_gia_de_thi']['#theme_wrappers'] = array();
    $form['field_gia_de_thi']['#prefix']='<div class="row"><div class="col-md-4">';
    $form['field_gia_de_thi']['#suffix']='</div>';
    $form['field_gia_de_thi']['und'][0]['value']['#attributes']['class'] = array('form-control');

    $form['field_tags']['#theme_wrappers'] = array();
    $form['field_tags']['und']['#attributes']['class'] = array('form-control');
    $form['body']['und'][0]['value']['#attributes']['class'] = array('form-control');
    $form['field_tags']['#prefix']='<div class="row"><div class="col-md-6">';
    $form['field_tags']['#suffix']='</div>';

    $form['field_bai_tap_lien_quan']['#theme_wrappers'] = array();

    $form['field_bai_tap_lien_quan']['#prefix']='<div class="col-md-6">';
    $form['field_bai_tap_lien_quan']['#suffix']='</div></div>';

    $form['field_gia_de_thi']['und'][0]['value']['#state'] =
      array('visible' => array(':input[name="field_gia_de_thi[und][0][value]"]' => array('value' => (int) 3))
    );

  }
  if($form_id=='user_register_form') {
    $form['#submit'] = array('custom_form_submit');
    $form['#prefix'] = t('<div class="row"><div class="col-md-12 mx-auto"><div class="box-login"><h5 class="title-login ">Cập nhật thông tin</h5>');
    $form['#suffix'] = t('</div></div></div>');
    $form['account']['name']['#attributes']['class'] = array('form-control');
    $form['account']['mail']['#attributes']['class'] = array('form-control d-none');
    $form['actions']['submit']['#attributes']['class'] = array('btn btn-primary btn-hover-secondary');
    $form['account']['pass']['#type'] = 'password';
    $form['account']['pass']['#title'] = 'Mật khẩu';
    $form['account']['pass']['#title_display'] = 'invisible';
    $form['account']['mail']['#title_display'] = 'invisible';
    $form['account']['pass']['#attributes']['class'] = array('form-control d-none');
    $form['account']['pass']['#attributes']['value'] = time();
    $form['account']['name']['#title'] = t('Họ tên');

    $form['field_so_dien_thoai']['und'][0]['value']['#attributes']['class'] = array('form-control');
  }elseif ($form_id=='user_login'){
    $form['#prefix'] = t('<div class="row"><div class="col-md-12 mx-auto"><div class="box-login"><h5 class="title-login ">Đăng nhập</h5>');
    $form['#suffix'] = t('</div></div></div>');
  }
}
/**
 * Implements hook_form_FORM_ID_alter().
 */
function form_tim_kiem()
{
  return '<form action="/tim-kiem">
            <input type="text" class="header-serach__input" name="title"
                   placeholder="Tìm kiếm tài liệu...">
            <button class="header-serach__btn"><i class="fas fa-search"></i>
            </button>
          </form>';
}
function custom_form_submit($form, &$form_state){
  user_register_submit($form, $form_state);
}
