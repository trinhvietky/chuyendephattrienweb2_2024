<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div style="margin-left: 250px; position: relative; display: inline-block;">
    <!-- Khung tròn xung quanh ảnh đại diện -->
    <div style="width: 80px; height: 80px; background-color: #808080; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
        <!-- Ảnh đại diện người dùng có thể nhấn để chọn ảnh mới -->
        <img src="{{ asset($user->image ?? 'img/icons/avatar_user.png') }}"
            alt="User Image"
            id="profileImage"
            style="width: 70px; height: 70px; border-radius: 50%; cursor: pointer;" />

        <!-- Biểu tượng máy ảnh -->
        <span style="position: absolute; bottom: -5px; right: -5px; background-color: #808080; border-radius: 50%; cursor: pointer; padding: 2px;">
            <img src="{{ asset('images/icons/camera_icon.png') }}" 
                alt="Camera Icon" 
                style="width: 25px; height: 25px; border-radius: 50%;" />
        </span>
    </div>

    <!-- Input file ẩn để chọn ảnh mới -->
    <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
</div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div>
            <x-input-label for="name" :value="__('Số điện thoại')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Script để kích hoạt input file khi nhấn vào ảnh hoặc biểu tượng máy ảnh -->
    <script>
    // Chọn ảnh khi nhấn vào ảnh hoặc biểu tượng máy ảnh
    document.getElementById('profileImage').onclick = function() {
        document.getElementById('imageInput').click(); // Mở hộp thoại chọn file
    };
    document.querySelector('span').onclick = function() {
        document.getElementById('imageInput').click(); // Mở hộp thoại chọn file khi nhấn vào biểu tượng máy ảnh
    };

    // Xử lý khi chọn ảnh
    document.getElementById('imageInput').addEventListener('change', function(event) {
        var formData = new FormData();
        formData.append('image', event.target.files[0]);  // Thêm ảnh vào FormData

        // Gửi yêu cầu AJAX để cập nhật hình ảnh
        fetch("{{ route('profile.update-avatar') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Lấy token CSRF
            },
            body: formData // Gửi FormData với file ảnh
        })
        .then(response => response.json()) // Khi server trả về JSON
        .then(data => {
            // Cập nhật ảnh trên giao diện ngay lập tức
            if (data.image_url) {
                // Cập nhật src của ảnh mới
                document.getElementById('profileImage').src = data.image_url;
            } else {
                console.error('Không nhận được URL ảnh từ server.');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
    });
</script>

</section>