@extends('layouts.app')

@section('content')
<v-app id="test">
    <v-content>
        <v-container>
            Hello world
            <v-btn color="info">Info</v-btn>
            <v-btn>Test</v-btn>
            <div v-ripple>
                DSADSADAD
            </div>
        </v-container>
    </v-content>
</v-app>
@endsection
