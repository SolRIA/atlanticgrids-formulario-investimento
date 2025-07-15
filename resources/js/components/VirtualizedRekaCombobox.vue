<template>
    <ComboboxRoot v-model="selectedItem">
        <div class="relative mt-1">
            <ComboboxInput class="w-full rounded-lg border-0 bg-white py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 outline-none"
                           :displayValue="(item) => item?.name" @change="query = $event.target.value"
                           placeholder="Search for a user..." />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                <ChevronsUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>
        </div>

        <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                        @after-leave="query = ''">
            <ComboboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                             :virtualized="true" :itemHeight="36" keyField="id">
                <div v-if="filteredItems.length === 0 && query !== ''"
                     class="relative cursor-default select-none py-2 px-4 text-gray-700">
                    No results found.
                </div>

                <ComboboxItem v-for="item in filteredItems" :key="item.id" :value="item" v-slot="{ selected, active }">
                    <li :class="[
                        'relative cursor-default select-none py-2 pl-10 pr-4',
                        active ? 'bg-blue-600 text-white' : 'text-gray-900',
                    ]">
                        <span :class="[
                            'block truncate',
                            selected ? 'font-medium' : 'font-normal',
                        ]">
                            {{ item.name }}
                        </span>
                        <span v-if="selected" :class="[
                            'absolute inset-y-0 left-0 flex items-center pl-3',
                            active ? 'text-white' : 'text-blue-600',
                        ]">
                            <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxItem>
            </ComboboxOptions>
        </TransitionRoot>
    </ComboboxRoot>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
import {
    ComboboxRoot,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxItem,
    TransitionRoot,
} from 'reka-ui'
import { CheckIcon, ChevronsUpDownIcon } from 'lucide-vue-next' // Using Heroicons v2 for icons

const props = defineProps({
    items: {
        type: Array,
        required: true,
        default: () => [],
    },
    modelValue: {
        type: Object, // Reka Combobox typically binds to the full object
        default: null,
    },
})

const emit = defineEmits(['update:modelValue'])

const query = ref('')
const selectedItem = ref(props.modelValue)

// Watch for external modelValue changes to update internal selectedItem
watch(() => props.modelValue, (newValue) => {
    selectedItem.value = newValue
})

// Watch for internal selectedItem changes to emit to parent
watch(selectedItem, (newValue) => {
    emit('update:modelValue', newValue)
})

const filteredItems = computed(() =>
    query.value === ''
        ? props.items
        : props.items.filter((item) =>
            item.name
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
)
</script>
