@foreach($users as $user)
<tr class=" @if(Auth::user()->id == $user->id) uk-disabled @endif">
    <td>{{ $user->username }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if($user->rule == 'admin')
      <span class="uk-text-success">مدیر</span>
      @else
      <span class="uk-text-muted">کاربر</span>
      @endif
    </td>
    <td>
      @if($user->state == 1)
      <span class="uk-text-muted">فعال</span>
      @else
      <span class="uk-text-danger">غیرفعال</span>
      @endif
    </td>
    <td>
      @if($user->state == 1)
      <!-- This is an anchor toggling the modal for lock user-->
      <a href="#user_{{ $user->id }}" uk-toggle>قفل</a>

      <!-- This is the modal -->
      <div id="user_{{ $user->id }}" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
              <h2 class="uk-modal-title"><span uk-icon="lock"></span> تایید عملیات</h2>
              <div class="uk-alert uk-alert-danger">
                <p>شما در حال قفل کردن کاربر {{ $user->username }} می‌باشید.<br /> آیا عملیات را تایید میکنید؟</p>
              </div>
              <p class="uk-text-right">
                <form class="" action="{{ route('User > Lock', $user->id) }}" method="post">
                  @csrf
                  <button class="uk-button uk-button-default uk-modal-close">لغو</button>
                  <button class="uk-button uk-button-primary" type="submit">تایید</button>
                </form>
              </p>
          </div>
      </div>
      @else
      <!-- This is an anchor toggling the modal for lock user-->
      <a href="#user_{{ $user->id }}" uk-toggle>فعال کردن</a>

      <!-- This is the modal -->
      <div id="user_{{ $user->id }}" uk-modal>
          <div class="uk-modal-dialog uk-modal-body">
              <h2 class="uk-modal-title"><span uk-icon="unlock"></span> تایید عملیات</h2>
              <div class="uk-alert uk-alert-success">
                <p>شما در حال فعال کردن  {{ $user->username }} می‌باشید.<br /> آیا عملیات را تایید میکنید؟</p>
              </div>
              <p class="uk-text-right">
                <form class="" action="{{ route('User > Unlock', $user->id) }}" method="post">
                  @csrf
                  <button class="uk-button uk-button-default uk-modal-close">لغو</button>
                  <button class="uk-button uk-button-primary" type="submit">تایید</button>
                </form>
              </p>
          </div>
      </div>
      @endif
    </td>
</tr>
@endforeach
