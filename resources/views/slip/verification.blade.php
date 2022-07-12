<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        @if(!empty($withdrawal_slip))
            <div class="font-medium text-sm text-green-600 mb-4">
                This document is a valid documents from {{ env('APP_NAME') }}
            </div>
        @else
            <div class="font-medium text-sm text-red-600 mb-4 text-center">
                Invalid or Unknown Document
            </div>
        @endif

        <hr class="mb-4">

        @if(!empty($withdrawal_slip))
            <div>
                <x-label :value="__('Document Date')" />
                
                <div class="mb-4 text-sm text-gray-500">
                    {{ $withdrawal_slip->created_at->format('d M Y') }}
                </div>
                <x-label :value="__('Document Series Number')" />
                
                <div class="mb-4 text-sm text-gray-500">
                    {{ $withdrawal_slip->document_series_no }}
                </div>

                <x-label :value="__('Approved By:')" />
                
                <div class="mb-4 text-sm text-gray-500">
                    {{ $withdrawal_slip->approved_by }}
                </div>
            </div>
        @endif

    </x-auth-card>
</x-guest-layout>
