<template>
  <div>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="News" />
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
            <div v-if="canLogin" class="hidden top-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-white">
            Dashboard
            </Link>
            <template v-else>
            <Link :href="route('login')" class="text-sm text-white">
            Log in
            </Link>
            <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-white">
            Register
            </Link>
            </template>
            </div>
            <Menu as="div" class="relative inline-block text-left">
            <div>
            <MenuButton class="inline-flex justify-center w-full rounded-md shadow-sm px-4 py-2 text-sm font-medium text-white hover:bg-blue">
            Language
            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none highzindex">
            <div class="py-1">
            <MenuItem v-slot="{ active }" v-for="eachlang in lang" :key="eachlang">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{eachlang}}</a>
            </MenuItem>
            </div>
            </MenuItems>
            </transition>
            </Menu>
              <Menu as="div" class="ml-3 relative" v-if="$page.props.auth.user">
                <div>
                  <MenuButton class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                  </MenuButton>
                </div>
                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                  <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                      <a :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ item.name }}</a>
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">Open main menu</span>
              <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>
      <DisclosurePanel class="md:hidden">
        <div class="pt-4 pb-3 border-t border-gray-700">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">{{ user.name }}</div>
              <div class="text-sm font-medium leading-none text-gray-400">{{ user.email }}</div>
            </div>
          </div>
          <div class="mt-3 px-2 space-y-1">
            <a v-for="item in userNavigation" :key="item.name" :href="item.href" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">{{ item.name }}</a>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>
    <header class="bg-white shadow pt-3" style="height:60px;">
        <div class="max-w-7xl mx-auto  grid grid-flow-row grid-cols-2 grid-rows-3 gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">
          News List
        </h1>
        </div>
        <div>
            <Menu as="div" class="relative inline-block text-left float-right">
            <div>
            <MenuButton class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
            Country
            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
            <MenuItem v-slot="{ active }" v-for="eachCountry in country" :key="eachCountry.id" >
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{eachCountry}}</a>
            </MenuItem>
            <form method="POST" action="#">
            <MenuItem v-slot="{ active }">
            <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full text-left px-4 py-2 text-sm']">
            Sign out
            </button>
            </MenuItem>
            </form>
            </div>
            </MenuItems>
            </transition>
            </Menu>
        </div>
        </div>
    </header>
    <main>
<div class="max-w-7xl mx-auto grid grid-cols-6 gap-4">
    <div class="col-start-1 col-end-2">
    <p class="text-gray-500 font-large mt-10 text-center">
        Sources
    </p>
    <ul class="list-none md:list-disc customlist">
        <li v-for="source in sources" :key="source">{{source.charAt(0).toUpperCase() + source.substring(1)}}</li>
    </ul>
  </div>
  <div class="col-start-3 col-span-6">
    <div v-for="news in newsdata" :key="news.id" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 grid grid-flow-col auto-cols-max">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
        <div class="md:flex-shrink-0">
        <img class="h-48 w-full object-cover md:h-full md:w-48" :src="news.urlToImage" alt="Man looking at item at a store">
        </div>
        <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
            {{news.author}}
        </div>
        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{news.title}}</a>
        <p class="mt-2 text-gray-500">
            {{news.description}}
        </p>
        </div>
        </div>
        </div>
    </div>
  </div>
</div>
    </main>
  </div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ChevronDownIcon } from '@heroicons/vue/solid'

const user = {
  name: 'Tom Cook',
  email: 'tom@example.com',
  imageUrl:
    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}

const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: '#' },
  { name: 'Sign out', href: '#' },
]

export default {
  components: {
    Head,
    Link,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    XIcon,
    ChevronDownIcon
  },
    props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    newsdata: Object,
    country: Object,
    lang: Object,
    sources: Object,
    },
  setup() {
    return {
      user,
      userNavigation,
    }
  },
}
</script>
<style scoped>
.highzindex{
    z-index: 9999999999;
}
.customlist li{
    list-style: none;
    height:40px;
    cursor: pointer;
    border-bottom: 1px solid #a1a1a1;
    transition: all 0.5s;
    padding-top: 10px;
}
.customlist li:hover{
    color:blue;
    margin-left: 4px;
    transition: all 0.5s;
}
</style>