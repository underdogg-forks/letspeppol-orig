<x-filament-panels::page>
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Column 1 -->
            <div class="space-y-6">
                <h1 class="text-3xl font-bold" style="color: var(--color-primary-700)">TailwindCSS Debug Page (Nord
                    Theme)
                </h1>
                <p class="" style="color: var(--color-polarnight-400)">This page is for visually testing the Nord color
                    palette and utility classes.</p>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Buttons</h2>
                    <button class="px-4 py-2 rounded hover:opacity-90"
                            style="background: var(--color-primary-500); color: var(--color-snowstorm-600)">Primary
                    </button>
                    <button class="px-4 py-2 rounded hover:opacity-90"
                            style="background: var(--color-secondary-200); color: var(--color-secondary-900)">Secondary
                    </button>
                    <button class="px-4 py-2 rounded hover:opacity-90"
                            style="background: var(--color-success-500); color: var(--color-snowstorm-600)">Success
                    </button>
                    <button class="px-4 py-2 rounded hover:opacity-90"
                            style="background: var(--color-danger-500); color: var(--color-snowstorm-600)">Danger
                    </button>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Alerts</h2>
                    <div class="p-4 rounded"
                         style="background: var(--color-info-100); color: var(--color-info-500)">Info alert
                    </div>
                    <div class="p-4 rounded"
                         style="background: var(--color-success-100); color: var(--color-success-500)">Success alert
                    </div>
                    <div class="p-4 rounded"
                         style="background: var(--color-warning-100); color: var(--color-warning-500)">Warning alert
                    </div>
                    <div class="p-4 rounded"
                         style="background: var(--color-danger-100); color: var(--color-danger-500)">Error alert
                    </div>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Badges</h2>
                    <span class="inline-block px-2 py-1 rounded-full text-xs"
                          style="background: var(--color-primary-200); color: var(--color-primary-800)">Primary</span>
                    <span class="inline-block px-2 py-1 rounded-full text-xs"
                          style="background: var(--color-success-200); color: var(--color-success-800)">Success</span>
                    <span class="inline-block px-2 py-1 rounded-full text-xs"
                          style="background: var(--color-warning-200); color: var(--color-warning-800)">Warning</span>
                    <span class="inline-block px-2 py-1 rounded-full text-xs"
                          style="background: var(--color-danger-200); color: var(--color-danger-800)">Danger</span>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Typography</h2>
                    <h3 class="text-lg font-bold" style="color: var(--color-secondary-700)">Heading 3</h3>
                    <p class="text-base"
                       style="color: var(--color-polarnight-700)">This is a normal paragraph. <span
                            class="font-semibold"
                            style="color: var(--color-primary-700)">Bold text</span> and
                        <span class="italic" style="color: var(--color-secondary-700)">italic text</span>.</p>
                    <ul class="list-disc pl-5 text-sm" style="color: var(--color-polarnight-500)">
                        <li>List item one</li>
                        <li>List item two</li>
                    </ul>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="space-y-6">
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Form Elements</h2>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium"
                                   style="color: var(--color-polarnight-700)">Text Input</label>
                            <input type="text"
                                   class="mt-1 block w-full rounded border shadow-sm focus:ring"
                                   style="border-color: var(--color-primary-200); color: var(--color-polarnight-900); background: var(--color-snowstorm-500);"
                                   placeholder="Type here...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium"
                                   style="color: var(--color-polarnight-700)">Select</label>
                            <select
                                class="mt-1 block w-full rounded border shadow-sm focus:ring"
                                style="border-color: var(--color-primary-200); color: var(--color-polarnight-900); background: var(--color-snowstorm-500)">
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="checkbox1"
                                   class="rounded border shadow-sm focus:ring"
                                   style="border-color: var(--color-primary-200); accent-color: var(--color-primary-500);">
                            <label for="checkbox1" class="text-sm"
                                   style="color: var(--color-polarnight-700)">Checkbox</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" id="radio1" name="radio" class="focus:ring"
                                   style="accent-color: var(--color-primary-500);">
                            <label for="radio1" class="text-sm"
                                   style="color: var(--color-polarnight-700)">Radio 1</label>
                            <input type="radio" id="radio2" name="radio" class="focus:ring"
                                   style="accent-color: var(--color-primary-500);">
                            <label for="radio2" class="text-sm"
                                   style="color: var(--color-polarnight-700)">Radio 2</label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium"
                                   style="color: var(--color-polarnight-700)">Textarea</label>
                            <textarea class="mt-1 block w-full rounded border shadow-sm focus:ring"
                                      rows="3"
                                      style="border-color: var(--color-primary-200); color: var(--color-polarnight-900); background: var(--color-snowstorm-500);"></textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 rounded hover:opacity-90"
                                style="background: var(--color-primary-500); color: var(--color-snowstorm-600)">
                            Submit
                        </button>
                    </form>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Table</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border text-sm"
                               style="border-color: var(--color-polarnight-200)">
                            <thead style="background: var(--color-snowstorm-400)">
                            <tr>
                                <th class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200); color: var(--color-polarnight-700)">
                                    Name
                                </th>
                                <th class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200); color: var(--color-polarnight-700)">
                                    Role
                                </th>
                                <th class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200); color: var(--color-polarnight-700)">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)">Alice
                                </td>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)">Admin
                                </td>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)"><span
                                        class="inline-block px-2 py-1 rounded-full text-xs"
                                        style="background: var(--color-success-200); color: var(--color-success-800)">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)">Bob
                                </td>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)">User
                                </td>
                                <td class="px-4 py-2 border-b"
                                    style="border-color: var(--color-polarnight-200)"><span
                                        class="inline-block px-2 py-1 rounded-full text-xs"
                                        style="background: var(--color-warning-200); color: var(--color-warning-800)">Pending</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Card Example</h2>
                    <div class="shadow rounded p-4"
                         style="background: var(--color-snowstorm-500)">
                        <h3 class="font-bold text-lg mb-2" style="color: var(--color-primary-700)">Card Title</h3>
                        <p style="color: var(--color-polarnight-700)">This is a card with some content. Use this to test
                            box
                            shadows, padding, and rounded corners.</p>
                        <button class="mt-3 px-3 py-1 rounded hover:opacity-90"
                                style="background: var(--color-primary-500); color: var(--color-snowstorm-600)">Action
                        </button>
                    </div>
                </div>

                <!-- Common Heroicons Section -->
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Common Heroicons</h2>
                    <div class="flex flex-wrap gap-6 items-center">
                        <div class="flex flex-col items-center">
                            <x-filament::icon name="heroicon-o-x-mark" class="w-8 h-8"
                                              style="color: var(--color-danger-500)" />
                            <span class="mt-1 text-xs" style="color: var(--color-polarnight-700)">X (Close)</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-filament::icon name="heroicon-o-paper-airplane" class="w-8 h-8"
                                              style="color: var(--color-primary-500)" />
                            <span class="mt-1 text-xs"
                                  style="color: var(--color-polarnight-700)">Paper Airplane (Send)</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-filament::icon name="heroicon-o-arrow-down-tray" class="w-8 h-8"
                                              style="color: var(--color-success-500)" />
                            <span class="mt-1 text-xs" style="color: var(--color-polarnight-700)">Arrow Down Tray (Download)</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-filament::icon name="heroicon-o-cloud-arrow-down" class="w-8 h-8"
                                              style="color: var(--color-secondary-500)" />
                            <span class="mt-1 text-xs"
                                  style="color: var(--color-polarnight-700)">Floppy Disk (Save)</span>
                        </div>
                    </div>
                </div>
                <!-- End Common Heroicons Section -->

                <!-- Direct Blade Heroicons Test Section -->
                <div class="space-y-2">
                    <h2 class="text-xl font-semibold" style="color: var(--color-primary-600)">Direct Blade Heroicons
                        Test</h2>
                    <div class="flex flex-wrap gap-6 items-center">
                        <div class="flex flex-col items-center">
                            <x-heroicon-o-x-mark class="w-8 h-8" style="color: var(--color-danger-500)" />
                            <span class="mt-1 text-xs"
                                  style="color: var(--color-polarnight-700)">X (Close) - Direct</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-heroicon-o-paper-airplane class="w-8 h-8" style="color: var(--color-primary-500)" />
                            <span class="mt-1 text-xs" style="color: var(--color-polarnight-700)">Paper Airplane (Send) - Direct</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-heroicon-o-arrow-down-tray class="w-8 h-8" style="color: var(--color-success-500)" />
                            <span class="mt-1 text-xs" style="color: var(--color-polarnight-700)">Arrow Down Tray (Download) - Direct</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <x-heroicon-o-cloud-arrow-down class="w-8 h-8" style="color: var(--color-secondary-500)" />
                            <span class="mt-1 text-xs" style="color: var(--color-polarnight-700)">Floppy Disk (Save) - Direct</span>
                        </div>
                    </div>
                </div>
                <!-- End Direct Blade Heroicons Test Section -->
            </div>
        </div>
    </div>
</x-filament-panels::page>

