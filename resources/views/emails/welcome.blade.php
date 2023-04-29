<!DOCTYPE html>
<html lang="{{$data['locale'] ?? 'en_US'}}">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2>{{ __('mails/welcome.hi_name_were_glad_youre_here', ['name' => $data['name']]) }}<br/></h2>
    <p>{{__('mails/welcome.best_regards')}}</p>
    <p>kuberGPT</p>
</body>
</html>
