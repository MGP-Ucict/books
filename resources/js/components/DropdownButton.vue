<template>
    <div :class="{'visible' : active}" class="cs-dropdown-menu">
        <div class="drop-down-btn" :class="{'drop-arrow' : arrow}" @click="toggle($event)">
            <div v-if="button" v-html="button">
            </div>
            <button v-else
                    class="dropdown-toggle bg-transparent border-0"
                    type="button">
            </button>
        </div>
        <div v-show="active" class="cs-dropdown-container">
            <div class="cs-dropdown-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'DropdownButton',
    props: {
        button: String, 
        arrow: String
    },
    data() {
        return {
            active: false,
            loaded: true,
            target: null,
        };
    },
    methods: {
        toggle(event) {
            this.target = this.target ? null : event.target;
            this.active = !this.active;
        },
    },
    mounted() {
        $( document ).ready(function() {
            $('.loaderSpiner').hide();
            $('.active-dropdown').removeClass();
        });
        document.getElementById('app')
            .addEventListener('click', (e) => {
                if (this.target) {
                    this.active = e.target === this.target;
                    this.target = e.target === this.target;
                }
        });
    },
};
</script>
