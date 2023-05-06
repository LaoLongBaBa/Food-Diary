<script setup>
import {Head, Link} from '@inertiajs/vue3';
import '@/../css/recipe/welcome.css';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome"/>
    <img class="welcome-bg" src="welcome_bg.jpg?t=123" alt="">
    <div class="relative min-h-screen selection:text-white">
        <!-- <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>
        </div> -->
        <div class="home-main" v-if="canLogin">
            <div class="home-top" v-if="$page.props.auth.user">
                <Link :href="route('recipes.index')"
                      class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    My Recipes
                </Link>
                <div class="text-welcme">
                    Food Diary
                </div>
            </div>

            <div v-else>
                <div class="text1"></div>
                <div class="text2">Food Diary</div>
                <div class="home-btn-box">
                    <Link :href="route('login')"
                          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Log in
                    </Link>

                    <Link v-if="canRegister" :href="route('register')"
                          class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Register
                    </Link>
                </div>
            </div>

        </div>
    </div>

    <div class="home-footer">
        <span>Copyright © 2023 Food Diary  </span>
        <a href="">Accessibility</a>
        <a href="">Terms & conditions</a>
        <a href="">Privacy policy</a>
        <a href="">Cookie policy</a>
    </div>
</template>
