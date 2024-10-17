<div class="card card-sm">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 9h8" />
                        <path d="M8 13h6" />
                        <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                    </svg>
                </span>
            </div>
            <div class="col">
                <div class="font-weight-medium">
                    Hello, <?= $_SESSION['user']['name'] ?>!
                </div>
                <div class="text-secondary mt-1">
                    <span class="">Motivation for today</span> : <span class="text-secondary fw-bold"><?= $data['motivation'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>