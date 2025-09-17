<style>
    input[type='checkbox'] {
        accent-color: white;
    }
</style>

<div class="w-full mb-4">
    <div class="m-auto flex flex-col items-center w-full max-w-screen gap-2 bg-blue-900 rounded p-4 md:max-w-2xl">
        <h2 class="text-xl">
            Szukaj planu zajęć
        </h2>
        <form action="/search" class="w-full flex flex-col items-center gap-4">
            <x-input
                name="search"
                placeholder="Szukaj"
                input-class="p-2 border border-blue-50 w-full rounded"
            />
            <div class="flex gap-2">
                <x-input
                    label="Grupy"
                    name="groups"
                    type="checkbox"
                    checked
                    input-label-class="flex gap-3 items-center"
                    input-class="p-2 border border-blue-50"
                />
                <x-input
                    label="Prowadzący"
                    name="conductors"
                    type="checkbox"
                    checked
                    input-label-class="flex gap-3 items-center"
                    input-class="p-2 border border-blue-50"
                />
                <x-input
                    label="Sale"
                    name="rooms"
                    type="checkbox"
                    checked
                    input-label-class="flex gap-3 items-center"
                    input-class="p-2 border border-blue-50"
                />
            </div>
            <button type="submit" class="py-2 px-4 rounded border border-blue-50">
                Szukaj
            </button>
        </form>
    </div>
</div>
