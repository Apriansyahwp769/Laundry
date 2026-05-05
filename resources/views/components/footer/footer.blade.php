<footer class="bg-gray-100 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col items-center gap-5 text-center">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="text-gray-800 font-bold text-lg tracking-tight hover:text-blue-600 transition-colors">
            LinenFresh
        </a>

        {{-- Footer Nav Links --}}
        <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2">
            <a href=""        class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Privacy Policy</a>
            <a href=""          class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Terms of Service</a>
            <a href="" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Sustainability</a>
            <a href=""        class="text-sm text-gray-500 hover:text-blue-600 transition-colors">Contact</a>
        </nav>

        {{-- Copyright --}}
        <p class="text-xs text-gray-400">
            &copy; {{ date('Y') }} LinenFresh. Systematic Trust in Every Wash.
        </p>

    </div>
</footer>