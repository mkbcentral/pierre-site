<div>
    <form id="contactForm" class="space-y-6" wire:submit.prevent="sendEmail">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block mb-2 text-gray-200">Nom complet</label>
                <input type="text" id="name" wire:model.blur="name" class="form-input" placeholder="Votre nom">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-gray-200">Email</label>
                <input type="email" id="email" wire:model.blur="email" class="form-input"
                    placeholder="Votre email">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="subject" class="block mb-2 text-gray-200">Formation d'intérêt</label>
            <select
                class="bg-gray-900 text-white border border-gray-700 rounded-lg w-full px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                wire:model.blur="category">
                <option value="">Selectionner une category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="message" class="block mb-2 text-gray-200">Message</label>
            <textarea id="message" rows="4" wire:model.blur="message" class="form-input"
                placeholder="Votre message ou question"></textarea>
            @error('message')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn-primary w-full">
            Envoyer ma demande
            <i class="fas fa-paper-plane ml-2"></i>
        </button>
    </form>
</div>
