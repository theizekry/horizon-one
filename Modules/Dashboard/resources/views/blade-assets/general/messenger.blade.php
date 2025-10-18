@if(session()->exists('record_deleted'))
    <x-dashboard::alerts.deleted-successfully />
@elseif(session()->exists('record_updated'))
    <x-dashboard::alerts.updated-successfully />
@elseif(session()->exists('new_record_added'))
    <x-dashboard::alerts.new-record-added />
@elseif(session()->exists('success'))
    <x-dashboard::alerts.success />
@elseif(session()->exists('error'))
    <x-dashboard::alerts.error />
@elseif(session()->exists('information'))
    <x-dashboard::alerts.info />
@endif
