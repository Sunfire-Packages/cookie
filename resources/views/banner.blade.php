<div x-data="{
            open: false,
            more: false,
            cookies: null,
            init() {
                this.$nextTick(async () => {
                    this.open = !sunfireCookie.acceptedStore()
                    this.fetchCookies()
                })
            },
            fetchCookies() {
                this.cookies = sunfireCookie.$cookies
            },
            async refresh() {
                this.cookies = await sunfireCookie.refreshData()
            },
            getEventData($event) {
                return {
                    'approve' : $event.target.getAttribute('checked') ? false : true,
                    'name' : $event.target.getAttribute('value')
                }
            },
            handleGroup($event) {
                const data = this.getEventData($event)

                data.approve
                    ? sunfireCookie.approveGroup(data.name)
                    : sunfireCookie.denyGroup(data.name)

                this.refresh()
            },
            handleCookie($event) {
                const data = this.getEventData($event)

                data.approve
                    ? sunfireCookie.approve(data.name)
                    : sunfireCookie.deny(data.name)

                this.refresh()

            },

            groupIsChecked(name) {
                if(this.cookies) {
                    return this.cookies.find((group) => group.name === name).checked
                }
            },

            accept() {
                sunfireCookie.acceptStore()
                this.open = false
            }
        }" x-init="init()">

    <div x-show.transition.duration.1000ms="!open"
         x-on:click="open = true"
         class="fixed bottom-0 right-0 mr-24 w-32 h-10 text-gray-800 bg-yellow flex justify-center items-center shadow hover:bg-gray-800 hover:text-yellow cursor-pointer transition easy-in duration-150">
        <p class="text-xl font-semibold">Cookies</p>
    </div>

    <div x-show.transition.duration.1000ms="open"
         x-bind:class="{'w-104': !more}"
         class="fixed bottom-0 right-0 mr-12 mb-12 border-2 border-yellow shadow-2xl bg-gray-800 text-white transition-all duration-500 ease-in-out"
         x-cloak>


        <div class="relative p-10 z-10 prose">

            <h1>Cookies</h1>

            <div x-show="!more" class="flex flex-wrap">

                <p>{!! trans('sun-cookie::text.message') !!}</p>

                <div class="mb-8">

                    <template x-if="cookies" x-for="(group, index) in cookies" :key="group.name">
                        <div x-show="group.cookies.length" class="mb-2">

                            <button x-on:click="handleGroup($event)"
                                    :key="'checkbox-' + index"
                                    :id="'checkbox-' + index"
                                    :name="'group' + index"
                                    :value="group.name"
                                    :checked="group.checked"
                                    :disabled="group.required" type="button" aria-pressed="false"
                                    :class="{'bg-gray-600' : group.checked, 'bg-gray-200' : !group.checked}"
                                    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-yellow">
                                <span class="sr-only" x-text="'Accept ' + group.name"></span>
                                <span aria-hidden="true"
                                      :class="{'translate-x-5' : group.checked, 'translate-x-0' : !group.checked}"
                                      class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>

                            <span class="ml-3" id="'for-checkbox-' + index">
                                <span class="font-medium text-white" x-text="group.required ? group.name + ' (required)' : group.name"></span>
                            </span>

                        </div>
                    </template>

                </div>

            </div>

            <div x-show="more" class="prose mb-10">

                <template x-if="cookies" x-for="(group, index) in cookies" :key="group.name">
                    <div x-show="group.cookies.length" class="mb-2">

                        <h2 x-text="group.name"></h2>

                        <template x-for="(cookie, index) in group.cookies">
                            <div :key="'cookie-' + index">

                                <div class="flex items-center justfy-center mb-1">

                                    <button :id="'checkbox-' + index"
                                            :value="cookie.name"
                                            :checked="cookie.checked"
                                            :disabled="group.required" x-on:click="handleCookie($event)"
                                            type="button" aria-pressed="false"
                                            :class="{'bg-gray-600' : cookie.checked, 'bg-gray-200' : !cookie.checked}"
                                            class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-yellow">
                                        <span class="sr-only" x-text="'Accept ' + cookie.name"></span>
                                        <span aria-hidden="true"
                                              :class="{'translate-x-5' : cookie.checked, 'translate-x-0' : !cookie.checked}"
                                              class="inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                    </button>

                                    <span class="ml-3" id="toggleLabel">
                                        <span class="font-medium text-white" x-text="cookie.required ? cookie.name + ' (required)' : cookie.name"></span>
                                    </span>

                                </div>

                                <div x-text="cookie.description"></div>
                            </div>
                        </template>
                    </div>
                </template>

            </div>

            <div class="w-full flex justify-end items-center space-x-4">

                <span x-on:click="more = !more"
                      x-text="!more ? '{{trans('sun-cookie::text.more')}}' : '{{trans('sun-cookie::text.less')}}'"
                      class="font-semibold cursor-pointer"></span>

                <button class="p-3 bg-yellow text-black" x-on:click="accept()">
                    {{ trans('sun-cookie::text.agree') }}
                </button>

            </div>
        </div>

    </div>
</div>