

@section('content')
        <div id="app">
            @extends('layouts.app')
            <v-app>
                <v-navigation-drawer app clipped v-model="drawer">
                    <v-btn width="256" flat to="/admin">管理者</v-btn>
                    <v-btn width="256" flat to="/place">撮影場所一覧</v-btn>
                    <v-btn width="256" flat to="/photo-display">写真素材一覧</v-btn>
                </v-navigation-drawer>
            
                <v-app-bar app clippedLeft flat style="left: 0px" dark>
                    <v-toolbar-title>一覧ページ</v-toolbar-title>
                </v-app-bar>
            
                <v-main>
                  <v-container fluid>
                    <router-view></router-view>
                  </v-container>
                </v-main>
            
                <v-footer app color="primary">
                </v-footer>
            </v-app>
        </div>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
