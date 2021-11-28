<form action="" x-data="{edit: true}" class="edit-profile-form">
    <div class="image-profile">
        <img src="https://www.anime-planet.com/images/characters/205377.jpg?t=1631194908" alt="">
    </div>
    <div class="user-form">
        <input class="user-form__name" type="text" value="udin" maxlength="20" x-bind:disabled="edit">
        <input class="user-form__desc" type="text" value="udin" maxlength="50" x-bind:disabled="edit">
        <div class="edit-button mt-4">
            <button class="btn rounded btn-outline-secondary btn-sm" x-on:click="edit = !edit"
                onclick="event.preventDefault()">
                Edit Profile
            </button>
            <input x-show="!edit" class="btn rounded btn-primary btn-sm mx-2" type="submit" value="Simpan">
        </div>
    </div>
</form>