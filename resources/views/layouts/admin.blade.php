<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <!-- needed since vuetify 2.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.8.95/css/materialdesignicons.css">

    <!-- admin.css here -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- app js values -->
    <script type="application/javascript">
        var LSK_APP = {};
        LSK_APP.APP_URL = '{{env('APP_URL')}}';
    </script>
</head>
<body>
<div id="admin">

    <template>
        <v-app id="inspire">

            <v-navigation-drawer
                    v-model="drawer"
                    dark
                    app
                    clipped
                    style="background-color: #17202f;"
                    left>

<!--                    
                    <v-col class="d-flex" cols="12" sm="12">
                  
                        <v-select
                        :items="items"
                        label="Select App"
                        outlined
                        dense
                        ></v-select>
                    
                        <app-selector></app-selector>
                    </v-col> -->
                      
                   
                <v-list dense>
                    @foreach($nav as $n)
                        @if($n["visible"])
                        @php
                            $route = $n["route_name"]
                        @endphp
                       
                            <v-list-item :to="{name: '{{$route}}'}" :exact="false">
                                <v-list-item-action>
                                    <v-icon>{{$n["icon"]}}</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        {{$n["label"]}}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        @else
                            <v-divider></v-divider>
                        @endif
                    @endforeach

                    <v-list-item @click="clickLogout('{{route('logout')}}','{{url('/')}}')">
                        <v-list-item-action>
                            <v-icon>directions_walk</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Logout</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                </v-list>
            </v-navigation-drawer>

            <v-app-bar app clipped-left elevation="1">
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                {{-- <v-toolbar-title>{{config('app.name')}}</v-toolbar-title> --}}
                <v-toolbar-title><!--<img src="img/triple-s-vida-logo.png" alt="TripleS - Vida" style="height: 42px; padding-top:10px">-->Octapi.io</v-toolbar-title>
            </v-app-bar>

            <v-content>
                {{-- <div>
                    <v-breadcrumbs>
                        <v-icon slot="divider">chevron_right</v-icon>
                        <v-breadcrumbs-item
                                v-for="item in getBreadcrumbs"
                                :exact="true"
                                :to="item.name"
                                :key="item.label"
                                :disabled="item.disabled">
                            @{{ item.label }}
                        </v-breadcrumbs-item>
                    </v-breadcrumbs>
                </div> --}}
                <v-divider></v-divider>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </v-content>
            <v-footer fixed>
                <span>&copy; 2017</span>
            </v-footer>
        </v-app>

        <!-- loader -->
        {{-- <div v-if="showLoader" class="wask_loader bg_half_transparent">
            <moon-loader color="red"></moon-loader>
        </div> --}}

        <!-- snackbar -->
        <v-snackbar
                :timeout="snackbarDuration"
                :color="snackbarColor"
                top
                v-model="showSnackbar">
            @{{ snackbarMessage }}
        </v-snackbar>

        <!-- dialog confirm -->
        <v-dialog v-show="showDialog" v-model="showDialog" absolute max-width="450px">
            <v-card>
                <v-card-title>
                    <div class="headline"><v-icon v-if="dialogIcon">@{{dialogIcon}}</v-icon> @{{ dialogTitle }}</div>
                </v-card-title>
                <v-card-text>@{{ dialogMessage }}</v-card-text>
                <v-card-actions v-if="dialogType=='confirm'">
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat="flat" @click.native="dialogCancel">Cancel</v-btn>
                    <v-btn color="green darken-1" flat="flat" @click.native="dialogOk">Ok</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- the progress bar -->
        <vue-progress-bar></vue-progress-bar>

    </template>

</div>

<!-- Scripts -->
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>