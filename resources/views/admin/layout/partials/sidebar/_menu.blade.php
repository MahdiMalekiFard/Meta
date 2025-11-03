@php use App\Enums\CategoryTypeEnum;use App\Enums\RoleEnum; @endphp
    <!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div
            id="kt_app_sidebar_menu_scroll"
            class="scroll-y my-5 mx-3"
            data-kt-scroll="true"
            data-kt-scroll-activate="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu"
            data-kt-scroll-offset="5px"
            data-kt-scroll-save-state="true"
        >
            <div
                class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                id="#kt_app_sidebar_menu"
                data-kt-menu="true"
                data-kt-menu-expand="false"
            >
                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                'title' => trans('_menu.dashboard'),
                'icon' => 'fa-solid fa-grid fs-2',
                'route' => '/admin',
                'exact'=>true,
            ])
                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.profile'),
                    'icon' => 'fad fa-user fs-2',
                    'route' => route('admin.profile.edit',['profile'=>auth()->user()->profile->id]),
                    'exact'=>true,
                    'has_permission' => true
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.data_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.users'),
                            'route' => route('admin.user.index'),
                        ],
                        [
                            'title' => trans('_menu.countries'),
                            'route' => route('admin.country.index'),
                        ],
                        [
                            'title' => trans('_menu.provinces'),
                            'route' => route('admin.province.index'),
                        ],
                        [
                            'title' => trans('_menu.cities'),
                            'route' => route('admin.city.index'),
                        ],
                        [
                            'title' => trans('_menu.localities'),
                            'route' => route('admin.locality.index'),
                        ],
                        [
                            'title' => trans('_menu.faqs'),
                            'route' => route('admin.faq.index'),
                        ],
                        [
                            'title' => trans('_menu.opinion'),
                            'route' => route('admin.opinion.index'),
                        ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.separator',[
                                   'title' => 'مدیریت محتوا',
                               ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.ticket_management'),
                    'icon' => 'fad fa-ticket fs-2',
                    'has_permission' => true,
                    'sub' => [
                        [
                            'title' => trans('_menu.ticket.all'),
                            'route' => route('admin.ticket.index'),
                        ],
                        [
                            'title' => trans('_menu.ticket.new'),
                            'route' => route('admin.ticket.create'),
                        ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                  'title' => trans('_menu.banner_management'),
                  'icon' => 'ki-solid ki-element-11 fs-2',
                  'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                  'sub' => [
                      [
                          'title' => trans('_menu.banner.all'),
                          'route' => route('admin.banner.index'),
                      ],
                      [
                          'title' => trans('_menu.banner.create'),
                          'route' => route('admin.banner.create'),
                      ],

                  ],
              ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                   'title' => trans('_menu.faq_management'),
                   'icon' => 'ki-solid ki-element-11 fs-2',
                  'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                   'sub' => [
                       [
                           'title' => trans('_menu.Faq.all'),
                           'route' => route('admin.faq.index'),
                       ],
                       [
                           'title' => trans('_menu.Faq.create'),
                           'route' => route('admin.faq.create'),
                       ],
                   ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.report_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.report.all'),
                            'route' =>  route('admin.report.index'),
                        ],
                        [
                            'title' => trans('_menu.report.pending'),
                            'route' => '#',
                        ],
                        [
                            'title' => trans('_menu.report.answered'),
                            'route' => '#',
                        ],
                        [
                            'title' => trans('_menu.report.reasons'),
                            'route' => route('admin.report-reason.index'),
                        ],
                        [
                            'title' => trans('_menu.report.closed'),
                            'route' => route('admin.category.index',['type'=>CategoryTypeEnum::REPORT->value]),
                        ],
                        [
                           'title' => trans('_menu.report_reason.all'),
                           'route' => route('admin.report-reason.index'),
                       ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.notice_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.notice.all'),
                            'route' => route('admin.notice.index'),
                        ],
                        [
                            'title' => trans('_menu.notice.published'),
                            'route' => route('admin.notice.index'),
                        ],
                        [
                            'title' => trans('_menu.notice.pending'),
                            'route' => route('admin.notice.index'),
                        ],
                        [
                            'title' => trans('_menu.notice.categories'),
                            'route' => route('admin.category.index',['type'=>CategoryTypeEnum::NOTICE->value]),
                        ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.blog_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.blog.all'),
                            'route' => route('admin.blog.index'),
                        ],
                        [
                            'title' => trans('_menu.blog.categories'),
                            'route' => route('admin.category.index',['type'=>CategoryTypeEnum::BLOG->value]),
                        ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.service_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.service.all'),
                            'route' => route('admin.service.index'),
                        ],

                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.plan_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.plan.all'),
                            'route' => route('admin.plan.index'),
                        ],

                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.server_management'),
                    'icon' => 'ki-solid ki-element-11 fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.server.all'),
                            'route' => route('admin.server.index'),
                        ],

                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                                  'title' => trans('_menu.comment.all'),
                                  'route' => route('admin.comment.index'),
                                  'icon' => 'fad fa-comment-pen fs-2',
                              ])

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                                   'title' => trans('_menu.setting'),
                                   'route' => route('admin.setting.index'),
                                    'icon' => 'fad fa-gear fs-2',
                                   'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                               ])
            </div>
        </div>
        <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->