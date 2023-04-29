<!DOCTYPE html>
<html lang="{{$data['locale'] ?? 'en_US'}}">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h2>{{ __('mails/welcome.hi_name_were_glad_youre_here_following_are_your_account_details', ['name' => $data['name']]) }}<br/></h2>
    <p>{{__('mails/welcome.heres_your_password')}}</p>
    <p>{{__('mails/welcome.password')}}: </p><p>{{$data['password']}}</p>
    <p>{{__('mails/welcome.please_change_it_as_soon_as_possible')}}</p>
    <p>{{__('mails/welcome.best_regards')}}</p>
    <p>kuberGPT</p>
</body>
</html>
