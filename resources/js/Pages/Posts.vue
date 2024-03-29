<script setup>
import { ref ,watch} from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import MainNavLayout from '@/Layouts/MainNavLayout.vue';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import Post from '../Components/Post.vue';

import Magnify from 'vue-material-design-icons/Magnify.vue'
import AccountMultiple from 'vue-material-design-icons/AccountMultiple.vue'
import Flag from 'vue-material-design-icons/Flag.vue'
import VideoImage from 'vue-material-design-icons/VideoImage.vue'
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'
import { useI18n } from 'vue-i18n';
defineProps({ posts: Object })
const user = usePage().props.auth.user
const { t, locale } = useI18n();
const changeLanguage = (language) => {
    locale.value = language; // Use locale.value to set the locale
    localStorage.setItem('locale', language);
};

const textDirection = ref('ltr');
const lang = ref('en');

// Watch locale changes and update text direction accordingly
watch(locale, (newLocale) => {
    textDirection.value = newLocale === 'ar' ? 'rtl' : 'ltr';
    lang.value = newLocale;
});
</script>

<template>
    <div :dir="locale.value === 'ar' ? 'rtl': 'ltr' " :style="`direction: ${textDirection}`">
    <Head title="Posts" />
    <MainNavLayout >
        <div class="fixed w-full h-[100%] bg-[#F1F2F5]">
            <div class="grid grid-rows-3 grid-flow-col w-full max-w-[1600px] mt-[56px] h-[calc(100%-56px)] mx-auto px-4">
                <div id="LeftSection" class="xl:w-[345px] lg:block hidden">
                    <div class="pt-4 max-w-[320px] pr-4">
                        <Link :href="route('profile.edit')" class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] p-2 rounded-md">
                            <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="/images/user-placeholder.png">
                            <div class="text-[15px] text-gray-800 font-extrabold pl-3">{{ user.name }}</div>
                        </Link>
                        <button class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] px-2 py-1.5 rounded-md">
                            <AccountMultiple :size="40" fillColor="#5BD7C6"/>
                            <div class="text-[15px] text-gray-800 font-extrabold pl-3">{{ $t("Friends") }}</div>
                        </button>
                       
                        <button  v-if="lang === 'ar'" @click="changeLanguage('en')" class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] px-2 py-1.5 rounded-md">
                            <Flag :size="40" fillColor="#c71625"/>
                            <div class="text-[15px] text-gray-800 font-extrabold pl-3"> {{ $t("English") }}</div>
                        </button>
                        <button v-if="lang === 'en'" @click="changeLanguage('ar')" class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] px-2 py-1.5 rounded-md">
                            <Flag :size="40" fillColor="#1fd70b"/>
                            <div class="text-[15px] text-gray-800 font-extrabold pl-3"> {{ $t('Arabic') }}</div>
                        </button>
                     
                    
                    </div>
                </div>

                <div id="PostsSection" class="row-span-6 max-w-[600px] lg:mx-0 mx-auto overflow-auto">

                    <CreatePostBox
                        :placeholder="$t('Whats on your mind ',{'user':user.name})"
                    />

                    <div v-for="post in posts.data" :key="post">
                        <Post :user="post.user" :post="post" :comments="post.comments" />
                    </div>

                </div>

                <div id="RightSection" class="pl-4 md:block hidden">
                    <div class="max-w-[340px] min-w-[250px] mx-auto pt-4">
                        <div class="flex items-center justify-between border-b border-b-gray-300">
                            <div class="font-semibold"> {{ $t('Contacts') }}</div>
                            <div class="flex items-center">
                                <div class="p-2 hover:bg-gray-300 rounded-full cursor-pointer">
                                    <VideoImage :size="23" fillColor="#050505"/>
                                </div>
                                <div class="p-2 hover:bg-gray-300 rounded-full cursor-pointer">
                                    <Magnify :size="23" fillColor="#050505"/>
                                </div>
                                <div class="p-2 hover:bg-gray-300 rounded-full cursor-pointer">
                                    <DotsHorizontal :size="23" fillColor="#050505"/>
                                </div>
                            </div>
                        </div>
                        <div class="h-[calc(100vh-115px)] overflow-auto pt-2">
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://picsum.photos/id/140/300/320">
                                <div class="text-[15px] text-gray-800 font-extrabold pl-3">Andrew Smith</div>
                            </div>
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://picsum.photos/id/141/300/320">
                                <div class="text-[15px] text-gray-800 font-extrabold pl-3">Wade Konopelski</div>
                            </div>
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://picsum.photos/id/142/300/320">
                                <div class="text-[15px] text-gray-800 font-extrabold pl-3">Thora Deckow</div>
                            </div>
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://picsum.photos/id/143/300/320">
                                <div class="text-[15px] text-gray-800 font-extrabold pl-3">Prof. Cooper Ratke</div>
                            </div>
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://picsum.photos/id/140/300/320">
                                <div class="text-[15px] text-gray-800 font-extrabold pl-3">Dennis Hackett</div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainNavLayout>
</div>

</template>
