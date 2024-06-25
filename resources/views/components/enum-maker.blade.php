
    <x-lvdb::card>
        <x-slot name="title">Create a new Enum</x-slot>
        <div
            x-init="getCode(); $watch('enumcases, enumName, returnType, enumNamespace', value => getCode())"
            x-data="{
                returnType: '-',
                enumNamespace: 'App\\Enums',
                enumName: 'Colour',
                enumcases: [
                    { label: 'Red', value: '1' },
                    { label: 'Green', value: '2' },
                    { label: 'Blue', value: '3' },
                ],
                newEnumCase: '',
                newEnumCaseValue: '',
                getters: ['getDescription'],
                enumCode: 'codey',
                getCode() {
                    fetch('/lara-vel-dev-buddy/enums/code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': @json(csrf_token())
                        },
                        body: JSON.stringify({
                            namespace: this.enumNamespace,
                            name: this.enumName,
                            returnType: this.returnType,
                            cases: this.enumcases,
                            getters: this.getters,
                        })
                    })
                    .then((data) => {
                        this.enumCode = data.text();
                    })
                }
            }"
        >

            <div class="grid grid-cols-12 gap-4">

                <div class="col-span-6">
                    <div class="flex gap-2">
                        <div class="grid w-64">
                            <label for="enum-name" class="ml-1 mb-1 text-sm">Namespace</label>
                            <input name="enum-namespace" type="text" class="col-span-3 px-2 py-1 rounded-md border dark:bg-black" x-model="enumNamespace">
                        </div>
                        <div class="grid w-64">
                            <label for="enum-name" class="ml-1 mb-1 text-sm">Name</label>
                            <input name="enum-name" type="text" class="col-span-3 px-2 py-1 rounded-md border dark:bg-black" x-model="enumName">
                        </div>
                        <div class="grid w-64">
                            <label for="enum-type" class="ml-1 mb-1 text-sm">Backed</label>
                            <select name="enum-type" class="col-span-3 px-2 py-1 rounded-md border dark:bg-black" x-model="returnType">
                                <option value="-">-</option>
                                <option value="string">string</option>
                                <option value="int">int</option>
                            </select>
                        </div>
                    </div>
                    <div x-show="enumName != ''">
                        <label for="enum-type" class="ml-1 mt-4 mb-1 text-sm">Cases</label>
                        <div class="">
                            <div class="">
                                <div class="">
                                    <template x-for="enumcase in enumcases">
                                        <div class="flex items-center gap-2 mb-1 pl-2 py-1 rounded-md hover:bg-sky-100">
                                            <input type="text" class="px-2 py-1 rounded-md border dark:bg-black" placeholder="Case label" x-model="enumcase.label">
                                            {{-- <span x-text="enumcase.label" class="font-medium"></span> --}}
                                            <span x-show="returnType != '-'" class="text-sm material-symbols-outlined">arrow_right_alt</span>
                                            <input x-show="returnType != '-'" type="text" class="px-2 py-1 rounded-md border dark:bg-black" placeholder="Case value" x-model="enumcase.value">
                                            {{-- <span x-show="returnType != '-'" x-text="enumcase.value" class="flex-1"></span> --}}

                                            <button type="button" class="border text-xs px-2 py-1 rounded-md bg-sky-200" x-on:click="enumcases.splice($el, 1)">Delete</button>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex items-center gap-2 my-1 pl-2 py-2 border-t">
                                    <input name="newEnumCase" type="text" class="px-2 py-1 rounded-md border dark:bg-black" placeholder="Case" x-model="newEnumCase">
                                    <span x-show="returnType != '-'" class="text-sm material-symbols-outlined">arrow_right_alt</span>
                                    <input x-show="returnType != '-'" name="newEnumCaseValue" type="text" class="px-2 py-1 rounded-md border dark:bg-black" placeholder="Value" x-model="newEnumCaseValue">
                                    <button type="button" class="border text-xs px-2 py-1 rounded-md bg-sky-200" x-on:click="enumcases.push({ label: newEnumCase, value: newEnumCaseValue }); newEnumCase = ''; newEnumCaseValue = ''">Add Case</button>
                                </div>
                            </div>
                        </div>

                        {{-- <p>Interfaces - traits</p>
                        <p>Getters...</p>
                        <template x-for="getter in getters">
                            <div class="mb-1 pl-2 py-1 rounded-md hover:bg-sky-100">
                                <span x-text="getter" class="font-medium"></span>
                                <template x-for="enumcase in enumcases">
                                    <div class="flex items-center gap-2 mb-1 pl-2 py-1 rounded-md hover:bg-sky-100">
                                        <span x-text="enumcase.label" class="font-medium"></span>
                                        <input type="text" class="px-2 py-1 rounded-md border">
                                        <span x-show="returnType != '-'" class="text-sm material-symbols-outlined">arrow_right_alt</span>
                                        <span x-show="returnType != '-'" x-text="enumcase.value" class="flex-1"></span>

                                        <button type="button" class="border text-xs px-2 py-1 rounded-md bg-sky-200" x-on:click="enumcases.splice($el, 1)">Delete</button>
                                    </div>
                                </template>
                            </div>
                        </template> --}}
                    </div>
                </div>
                <div class="col-span-6">
                    <button x-on:click="getCode()">Get Code</button>
                    <pre x-html="enumCode" class="bg-black text-green-600 rounded-lg p-4">
                    code
                    </pre>
                </div>
            </div>
        </div>
    </x-lvdb::card>