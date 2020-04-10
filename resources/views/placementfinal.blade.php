<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div>

            <div class="content">
            <a href="/" class="btn-md btn">Home</a><br>
                <div class="title m-b-sm">
                    Placement
                </div>

                <div>
                <b>
                {{$pairs['final']['round']}}
                </b>
                </div>

                <div>
                <form id="placementform"  action="{{ route('finish-round') }}" method="post" data-toggle="validator">
                    {{csrf_field()}}
                    <input id="inputhidden" type='hidden' name='_method' value='POST'>
                <b>
                <table id="costtable" class="table table-bordered table-hover" style= "width :100%" >
                <thead>
                <tr>
                <th style="text-align:center">Match</th>
                <th style="text-align:center">Player</th>
                <th style="text-align:center">Winner</th>
                <th style="text-align:center">Round</th>
                </tr>
                </thead>
                <tbody>
                    <input id="match" type='hidden' name='match[0]' value="{{$pairs['final']['match']}}">
                    <tr>
                        <td style="text-align:center">Match : {{$pairs['final']['match']}}</td>
                        <td style="text-align:center">{{$pairs['final']['participant']['participant1']}} vs {{$pairs['final']['participant']['participant2']}}</td>
                        <td style="text-align:center">
                        <select name="winner[0]" id="winner" class="form-control">
                            <option value="{{$pairs['final']['participant']['participant1']}}|{{$pairs['final']['participant']['participant2']}}">{{$pairs['final']['participant']['participant1']}}</option>
                            <option value="{{$pairs['final']['participant']['participant2']}}|{{$pairs['final']['participant']['participant1']}}">{{$pairs['final']['participant']['participant2']}}</option>
                        </select>
                        </td>
                        <td style="text-align:center">{{$pairs['final']['round']}}</td>
                    </tr>
                    <input id="match" type='hidden' name='match[1]' value="{{$pairs['consolation']['match']}}">
                    <tr>
                        <td style="text-align:center">Match : {{$pairs['consolation']['match']}}</td>
                        <td style="text-align:center">{{$pairs['consolation']['participant']['participant1']}} vs {{$pairs['consolation']['participant']['participant2']}}</td>
                        <td style="text-align:center">
                        <select name="winner[1]" id="winner" class="form-control">
                            <option value="{{$pairs['consolation']['participant']['participant1']}}|{{$pairs['consolation']['participant']['participant2']}}">{{$pairs['consolation']['participant']['participant1']}}</option>
                            <option value="{{$pairs['consolation']['participant']['participant2']}}|{{$pairs['consolation']['participant']['participant1']}}">{{$pairs['consolation']['participant']['participant2']}}</option>
                        </select>
                        </td>
                        <td style="text-align:center">{{$pairs['consolation']['round']}}</td>
                    </tr>
		        </tbody>
                
                </table>
                <input id="submit" type="submit" class="form-control btn-primary" value="Finish">
                </b>
                </form>
                </div>

            </div>
        </div>
    </body>
</html>
