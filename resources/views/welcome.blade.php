<!doctype html>
    <head>

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace);font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width>=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:"*";inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:"*";inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:"*";inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:"*";inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}
        </style>
    @endif


    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Aalokbortika - Online Admission Management</title>
    <meta name="author" content="Aalokbortika">
    <meta name="description" content="Aalokbortika - Online Admission Management">
    <meta name="keywords" content="Aalokbortika - Online Admission Management">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <!-- Swiper Js -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>


<body>

       <!--********************************
   		Code Start From Here 
	******************************** -->

    
    <!-- <div class="preloader ">
        <button class="th-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <img src="{{ asset('assets/img/logo.png') }}" style="width:250px;" alt="img">
            <span class="loader">
                Aalokbortika
                <span class="loading-text">Aalokbortika</span>
            </span>
        </div>
    </div> -->
    <!--==============================
    Sidemenu
============================== -->
    <div class="sidemenu-wrapper ">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <div class="widget footer-widget">
                <div class="th-widget-about">
                    <div class="about-logo">
                        <a href="home-university.html">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Aalokbortika">
                        </a>
                    </div>
                    <p class="about-text">Since 1999, when the newly minted Aalokbortika team embraced its mandate to breathe new life into the downtrodden neighbourhood, East Village's transformation has been nothing short of remarkable. </p>
                    <div class="footer-info">
                        <a href="#">
                            <span class="footer-info-icon"><i class="fa-solid fa-location-dot"></i></span> 45 New Eskaton Road, Austria
                        </a>
                        <a href="mailto:infomail@example.com">
                            <span class="footer-info-icon"><i class="fa-solid fa-envelope"></i></span> infomail@example.com
                        </a>
                    </div>
                </div>
            </div>
            <div class="widget footer-widget">
                <h3 class="widget_title">Recent Posts</h3>
                <div class="recent-post-wrap">
                    <div class="recent-post">
                        <div class="media-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blog/recent-post-1-1.jpg') }}" alt="Blog Image"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title">
                                <a class="text-inherit" href="blog-details.html">Trailblazers in Faculty Perspectives</a>
                            </h4>
                            <div class="recent-post-meta">
                                <a href="blog.html"><i class="far fa-calendar"></i>26/6/2025</a>
                            </div>
                        </div>
                    </div>
                    <div class="recent-post">
                        <div class="media-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blog/recent-post-1-2.jpg') }}" alt="Blog Image"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Future Focus Preparing for Tomorrow</a></h4>
                            <div class="recent-post-meta">
                                <a href="blog.html"><i class="far fa-calendar"></i>24/6/2025</a>
                            </div>
                        </div>
                    </div>
                    <div class="recent-post">
                        <div class="media-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blog/recent-post-1-3.jpg') }}" alt="Blog Image"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title">
                                <a class="text-inherit" href="blog-details.html">The Green Initiative Sustainability in Action</a>
                            </h4>
                            <div class="recent-post-meta">
                                <a href="blog.html"><i class="far fa-calendar"></i>24/6/2025</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget footer-widget">
                <h3 class="widget_title">Popular Tags</h3>
                <div class="th-social">
                    <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                    <a href="https://pinterest.com"><i class="fab fa-pinterest-p"></i></a>
                    <a href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://linkedin.com"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-search-box">
        <button class="searchClose"><i class="far fa-times"></i></button>
        <form action="#">
            <input type="text" placeholder="What are you looking for?">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div><!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="home-university.html"><img src="{{ asset('assets/img/logo.png') }}" alt="Aalokbortika"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="home-university.html">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">University Home</a></li>
                            <li><a href="home-admission.html">Admission Home</a></li>
                            <li><a href="home-courses.html">Course Home</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li class="menu-item-has-children">
                        <a href="#">Programs</a>
                        <ul class="sub-menu">
                            <li><a href="program.html">Programs Style 1</a></li>
                            <li><a href="program-2.html">Programs Style 2</a></li>
                            <li><a href="program-details.html">Program Details</a></li>
                            <li><a href="program-details-sidebar.html">Program Details With Sidebar</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul class="sub-menu">
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="shop-details.html">Shop Details</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Faculties</a>
                                <ul class="sub-menu">
                                    <li><a href="faculty.html">Faculty</a></li>
                                    <li><a href="faculty-details.html">Faculty Details</a></li>
                                </ul>
                            </li>
                            <li><a href="alumni.html">Alumni Page</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Researches</a>
                                <ul class="sub-menu">
                                    <li><a href="research.html">Research</a></li>
                                    <li><a href="research-details.html">Research Details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Teachers</a>
                                <ul class="sub-menu">
                                    <li><a href="teacher.html">Teacher</a></li>
                                    <li><a href="teacher-details.html">Teacher Details</a></li>
                                </ul>
                            </li>
                            <li><a href="campus.html">Campus Life</a></li>
                            <li><a href="pricing.html">Pricing Plan</a></li>
                            <li><a href="faq.html">Faqs Page</a></li>
                            <li><a href="error.html">Error Page</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Events</a>
                        <ul class="sub-menu">
                            <li><a href="event.html">Events Page</a></li>
                            <li><a href="event-details.html">Event Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Blogs</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                            <li><a href="blog-details-sidebar.html">Blog Details With Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!--==============================
    Header Area
==============================-->
    <header class="th-header header-layout2 header-layout3 onepage-nav">
        <div class="header-top">
            <div class="th-container4 container">
                <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                    <div class="col-auto d-none d-lg-block">
                        <div class="header-links style2">
                            <ul class="header-left-wrap">
                                <li><a href="#"><i class="fa-solid fa-location-dot"></i>16/1 Saha Para Road, Magura Sadar</a></li>
                                <li><a href="mailto:infomail@example.com"><i class="fa-solid fa-envelope"></i>info@aalokbortika-bd.com</a></li>
                                <li><a href="mailto:infomail@example.com"><i class="fa-solid fa-phone"></i>+880 182 2108003</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-links">
                            <ul class="header-right-wrap">
                                {{-- Logic to toggle between Login/Register and Dashboard --}}
                                @guest
                                    <li>
                                        <i class="fa-solid fa-user"></i>
                                        <a href="#login-form" class="popup-content">Login / Register</a>
                                    </li>
                                @else
                                    <li>
                                        <i class="fa-solid fa-gauge"></i>
                                        {{-- Points to the /redirect route defined in web.php which handles role-based redirection --}}
                                        <a href="{{ url('/redirect') }}">Dashboard</a>
                                    </li>
                                @endguest

                                <li>
                                    <i class="fas fa-comments"></i><a href="faq.html">FAQ</a>
                                </li>
                                <li>
                                    <div class="dropdown-link">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('assets/img/icon/lang.png') }}" alt=""> </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li>
                                                <a href="#">German</a>
                                                <a href="#">French</a>
                                                <a href="#">Italian</a>
                                                <a href="#">Latvian</a>
                                                <a href="#">Spanish</a>
                                                <a href="#">Greek</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--==============================
Hero Area 3
==============================-->
    <div class="th-hero-wrapper hero-3 position-relative overflow-hidden" id="hero">
        <div class="swiper th-slider hero-slider3" id="heroSlide" data-slider-options='{"effect":"fade", "autoHeight": "true", "autoplay" : "false"}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-inner">
                        <div class="th-hero-bg" data-bg-src="{{ asset('assets/img/hero/hero-3-1.jpg') }}"></div>
                        <div class="container th-container4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="hero-style3">
                                        <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">Unlock Your Potential With Aalokbortika 2500+ Courses</h1>
                                        <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">We want
                                            every student and study partner to feel that they are part of a common good and
                                            cohesive team. We help our teams form stronger relationships.</p>
                                        <div class="hero-search-wrap" data-ani="slideinup" data-ani-delay="0.7s">
                                            <form action="#">
                                                <input type="text" placeholder="What do you want to learn?" autocomplete="off">
                                                <button type="submit"><i class="fal fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="hero-video" data-ani="slideinup" data-ani-delay="0.8s">
                                        <a href="https://www.youtube.com/watch?v=EZfLOSQ8hW8" class="video-play-btn popup-video">
                                            <i class="fa-sharp fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-inner">
                        <div class="th-hero-bg" data-bg-src="{{ asset('assets/img/hero/hero-3-1.jpg') }}"></div>
                        <div class="container th-container4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="hero-style3">
                                        <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">Discover Your Future: 2500+ Courses at Aalokbortika</h1>
                                        <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">We want
                                            every student and study partner to feel that they are part of a common good and
                                            cohesive team. We help our teams form stronger relationships.</p>
                                        <div class="hero-search-wrap" data-ani="slideinup" data-ani-delay="0.7s">
                                            <form action="#">
                                                <input type="text" placeholder="What do you want to learn?" autocomplete="off">
                                                <button type="submit"><i class="fal fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="hero-video" data-ani="slideinup" data-ani-delay="0.8s">
                                        <a href="https://www.youtube.com/watch?v=EZfLOSQ8hW8" class="video-play-btn popup-video">
                                            <i class="fa-sharp fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-inner">
                        <div class="th-hero-bg" data-bg-src="{{ asset('assets/img/hero/hero-3-1.jpg') }}"></div>
                        <div class="container th-container4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="hero-style3">
                                        <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">Learn. Grow. Excel — 2500+ Courses from Aalokbortika</h1>
                                        <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">We want
                                            every student and study partner to feel that they are part of a common good and
                                            cohesive team. We help our teams form stronger relationships.</p>
                                        <div class="hero-search-wrap" data-ani="slideinup" data-ani-delay="0.7s">
                                            <form action="#">
                                                <input type="text" placeholder="What do you want to learn?" autocomplete="off">
                                                <button type="submit"><i class="fal fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="hero-video" data-ani="slideinup" data-ani-delay="0.8s">
                                        <a href="https://www.youtube.com/watch?v=EZfLOSQ8hW8" class="video-play-btn popup-video">
                                            <i class="fa-sharp fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-inner">
                        <div class="th-hero-bg" data-bg-src="{{ asset('assets/img/hero/hero-3-1.jpg') }}"></div>
                        <div class="container th-container4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="hero-style3">
                                        <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">Upgrade Your Skills with Aalokbortika's 2500+ Courses</h1>
                                        <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">We want
                                            every student and study partner to feel that they are part of a common good and
                                            cohesive team. We help our teams form stronger relationships.</p>
                                        <div class="hero-search-wrap" data-ani="slideinup" data-ani-delay="0.7s">
                                            <form action="#">
                                                <input type="text" placeholder="What do you want to learn?" autocomplete="off">
                                                <button type="submit"><i class="fal fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="hero-video" data-ani="slideinup" data-ani-delay="0.8s">
                                        <a href="https://www.youtube.com/watch?v=EZfLOSQ8hW8" class="video-play-btn popup-video">
                                            <i class="fa-sharp fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-pagination style4"></div>
        </div>
    </div>
    <!--======== / Hero Section ========-->
    <div class="short-services-area-1 position-relative overflow-hidden ">
        <div class="container th-container3">
            <div class="short-services-wrap1">
                <div class="short-services-social">
                    <div class="th-social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="short-services-items">
                    <div class="short-services-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/counter-icon1-1.svg') }}" alt="Aalokbortika">
                        </div>
                        <div class="short-services-text">
                            <h3 class="box-title"><span class="counter-number">2300</span> + </h3>
                            <p class="box-text">Online Courses</p>
                        </div>
                    </div>
                    <div class="short-services-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/counter-icon1-4.svg') }}" alt="Aalokbortika">
                        </div>
                        <div class="short-services-text">
                            <h3 class="box-title">Expert Instructors</h3>
                            <p class="box-text">Find the right instructor</p>
                        </div>
                    </div>
                    <div class="short-services-item">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/counter-icon1-2.svg') }}" alt="Aalokbortika">
                        </div>
                        <div class="short-services-text">
                            <h3 class="box-title">Lifetime Access</h3>
                            <p class="box-text">Learn on you rschedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
About Area  3
==============================-->
    <div class="overflow-hidden about-area-3 space position-relative" id="about-sec">
        <div class="about-shape shape-mockup jump" data-bottom="0%" data-left="2%"><img src="{{ asset('assets/img/shape/about-3-1.png') }}" alt="Aalokbortika"></div>
        <div class="container th-container3">
            <div class="row gy-4 gx-65">
                <div class="col-xxl-6 col-xl-5 col-md-12">
                    <div class="img-box5">
                        <div class="img1 reveal">
                            <img src="{{ asset('assets/img/about/about-thumb3-1.jpg') }}" alt="Aalokbortika">
                        </div>
                        <div class="img2 reveal">
                            <img src="{{ asset('assets/img/about/about-thumb3-2.jpg') }}" alt="Aalokbortika">
                        </div>
                        <div class="counter-card3 wow fadeInUp" data-wow-delay=".3s">
                            <h3 class="box-number text-white">
                                <span class="counter-number">280</span> k+
                            </h3>
                            <p class="box-text text-white">World-wide Happy Students</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-7 col-md-12">
                    <div class="about-content">
                        <div class="title-area-wrap">
                            <div class="title-area pe-xl-5 mb-40">
                                <span class="sub-title text-anim">About Us</span>
                                <h2 class="sec-title text-anim2"> Delivering top <span class="text-theme">motivational</span> <span class="d-block">courses to you</span></h2>
                            </div>
                            <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".3s">At Aalokbortika, you'll be
                                welcomed into a diverse community of learners of different races, genders, ages and
                                ethnicities. With online and on-campus learning available, our students are
                                scattered around the country and the world.
                            </p>
                            <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".4s">We want each student to
                                feel included, supported and recognized as they earn their degree. No matter where
                                you come from, earning a degree is a challenging but rewarding.
                            </p>
                        </div>
                        <div class="checklist-wrap mt-45">
                            <div class="checklist list-two-column style1">
                                <ul>
                                    <li class="wow fadeInUp" data-wow-delay=".4s"> Highly Professinal Staff</li>
                                    <li class="wow fadeInUp" data-wow-delay=".5s"> 100% satisfaction guarantee</li>
                                    <li class="wow fadeInUp" data-wow-delay=".6s"> Quality control system</li>
                                    <li class="wow fadeInUp" data-wow-delay=".7s"> Engaging adn dynamic presention</li>
                                    <li class="wow fadeInUp" data-wow-delay=".8s"> Proven track record of success</li>
                                    <li class="wow fadeInUp" data-wow-delay=".9s"> 24/7 Enhance customer care</li>
                                </ul>
                            </div>

                        </div>
                        <div class="btn-wrap mt-60 wow fadeInUp" data-wow-delay=".9s">
                            <a href="about.html" class="th-btn th-icon">Apply To Aalokbortika</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
Cat Area Home 3
==============================-->
    <section class="cat-area-1 position-relative overflow-hidden space">
        <div class="shape-mockup" data-top="0%" data-left="0%"><img src="{{ asset('assets/img/shape/feature-shep-home-1.png') }}" alt="Aalokbortika"></div>
        <div class="container th-container3">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8 col-md-8">
                    <div class="title-area">
                        <span class="sub-title text-anim">CATEGORIES</span>
                        <h2 class="sec-title text-anim2">Browse Top categories</h2>
                    </div>
                </div>
            </div>
            <div class="cat-wrap1">

                <!--==============================
Cta Area  
==============================-->
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".1s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-1.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Science & Technology</a></h3>
                            <p class="box-text">10 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".2s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-2.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Design & Arts</a></h3>
                            <p class="box-text">12 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".3s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-3.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Web Development</a></h3>
                            <p class="box-text">10 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".4s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-4.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Data Science</a></h3>
                            <p class="box-text">18 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".5s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-1.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Video & Photography</a></h3>
                            <p class="box-text">13 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".6s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-1.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Artificial Intelligence</a></h3>
                            <p class="box-text">20 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".7s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-1.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Ideology</a></h3>
                            <p class="box-text">15 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="cat-card wow fadeInUp" data-wow-delay=".8s">
                        <div class="box-icon">
                            <img src="{{ asset('assets/img/icon/cat-3-5.png') }}" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title"><a href="#">Mathematics</a></h3>
                            <p class="box-text">10 Courses</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-wrap text-center d-block wow fadeInUp" data-wow-delay=".3s">
                <a class="th-btn style-border2" href="#">Browse All Categories</a>
            </div>
        </div>
        <div class="cat-shape shape-mockup jump" data-bottom="15%" data-left="10%"><img src="{{ asset('assets/img/shape/cat-3-1.png') }}" alt="Aalokbortika"></div>
        <div class="shape-mockup" data-bottom="0%" data-right="0%"><img src="{{ asset('assets/img/shape/feature-shep-2-home-1.png') }}" alt="Aalokbortika"></div>
    </section>
    <section class="popular-course-area-1 space">
        <div class="container th-container4">
            <div class="row justify-content-xl-between justify-content-center align-items-center">
                <div class="col-xl-6 col-12">
                    <div class="title-wrap">
                        <div class="title-area text-center text-xl-start">
                            <span class="sub-title text-anim">POPULAR CAUSES</span>
                            <h2 class="sec-title text-anim2">Pick a course & get start excellent journey</h2>
                        </div>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn">
                        <ul class="nav nav-tabs course-tabs popularcourse-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active th-btn style-border1" id="undergraduate-tab" data-bs-toggle="tab" data-bs-target="#undergraduateTab" type="button" role="tab" aria-controls="undergraduateTab" aria-selected="true">Undergraduate</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link th-btn style-border1" id="graduate-tab" data-bs-toggle="tab" data-bs-target="#graduateTab" type="button" role="tab" aria-controls="graduateTab" aria-selected="false">Graduate</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link th-btn style-border1" id="online-tab" data-bs-toggle="tab" data-bs-target="#onlineTab" type="button" role="tab" aria-controls="onlineTab" aria-selected="false">Online</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link th-btn style-border1" id="shortcourse-tab" data-bs-toggle="tab" data-bs-target="#shortcourseTab" type="button" role="tab" aria-controls="shortcourseTab" aria-selected="false">Short Course</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="undergraduateTab" role="tabpanel" aria-labelledby="undergraduate-tab">
                    <div class="popular-course-wrap1">
                        <div class="row gy-24">

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-1.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Engineering</a></div>
                                        <h3 class="box-title"><a href="program.html">Master Degree Technology Elevate Your Career</a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-1.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Michel John</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-2.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Language</a></div>
                                        <h3 class="box-title"><a href="program.html">A Practical Course for Speaking English Correctly </a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-2.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Albert James</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-3.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Web Development</a></div>
                                        <h3 class="box-title"><a href="program.html">Web Development Fundamental Building your Career</a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-3.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Rebeka Smith</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-4.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Fine of Arts</a></div>
                                        <h3 class="box-title"><a href="program.html">Boost Your Creativity & Expand the Your Career</a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-4.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Jenny Wilson</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-5.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Development</a></div>
                                        <h3 class="box-title"><a href="program.html">Computer Science and Engineering Building </a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-5.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Leslie Alexander</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-12">
                                <div class="course-card">
                                    <div class="course-img-thumb global-img">
                                        <img src="{{ asset('assets/img/popular-course/course-thumb-3-6.jpg') }}" alt="Aalokbortika">
                                        <a href="#" class="wishlist-icon"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="card-content">
                                        <div class="tag"><a href="#">Engineering</a></div>
                                        <h3 class="box-title"><a href="program.html">Programming (Python, Java, C++) Building </a></h3>
                                        <div class="course-rating">
                                            <div class="star-rating" role="img" aria-label="Rated 4.00 out of 5">
                                                <span class="rating-icon"></span>
                                            </div>
                                            <p class="rating-text">4.9 (10k)</p>
                                        </div>
                                        <div class="blog-meta course-meta">
                                            <a href="#"><img src="{{ asset('assets/img/icon/open-book-small.svg') }}" alt="Aalokbortika"> 12 Semesters</a>
                                            <a href="#"><i class="fa-solid fa-calendar-days"></i> 4 Years</a>
                                            <a href="#"><img src="{{ asset('assets/img/icon/book-read.svg') }}" alt="Aalokbortika">250 Seats</a>
                                        </div>
                                        <div class="card-content-bottom">
                                            <div class="author">
                                                <img src="{{ asset('assets/img/popular-course/course-mentor-3-6.jpg') }}" alt="Aalokbortika">
                                                <p><a href="program.html">Maliha Doe</a></p>
                                            </div>
                                            <div class="btn-wrap">
                                                <a class="th-btn th-icon style-border1" href="program.html">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat the same pattern for other tabs (graduateTab, onlineTab, shortcourseTab) with asset helpers -->
            </div>
            <div class="btn-wrap mt-50 text-center d-block">
                <a class="th-btn th-icon" href="#">Browse All Categories</a>
            </div>
        </div>
        <div class="popular-area-shape shape-mockup jump d-none d-xl-block" data-bottom="0%" data-left="2%"><img src="{{ asset('assets/img/shape/popular-3-1.png') }}" alt="Aalokbortika"></div>
    </section>
    <!-- Continue adding asset helpers to the remaining sections... -->
    <section class="why-area-3 overflow-hidden position-relative ">
        <div class="shape-mockup z-index-3 jump d-none d-xxl-block" data-left="40%" data-top="14%"><img src="assets/img/shape/cat-3-1.png" alt="Aalokbortika"></div>
        <div class="container th-container4">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="space">
                        <div class="title-area">
                            <span class="sub-title text-anim">WHY CHOOSE US</span>
                            <h2 class="sec-title text-anim2">The advantages of our Courses</h2>
                            <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">At Aalokbortika, you’ll be welcomed
                                into a
                                diverse community of learners of different races, genders, ages and ethnicities. With online
                                and on-campus learning available.</p>
                        </div>
                        <div class="checklist style5">
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay=".3s">We offer consistently with your-round
                                    schedules</li>
                                <li class="wow fadeInUp" data-wow-delay=".4s">We have highly experienced
                                    instructors</li>
                                <li class="wow fadeInUp" data-wow-delay=".5s">We support you to ensure the success
                                </li>
                                <li class="wow fadeInUp" data-wow-delay=".6s">Get live class before start courses
                                </li>
                            </ul>
                        </div>
                        <div class="btn-wrap mt-50 wow fadeInUp" data-wow-delay=".7s">
                            <a href="about.html" class="th-btn th-icon">Get More Info</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="why-video-bg overflow-hidden gsap-parallax">
                        <img src="assets/img/why/why-video3-1.jpg" alt="image">
                        <div class="why-video-btn">
                            <a href="https://www.youtube.com/watch?v=EZfLOSQ8hW8" class="video-play-btn popup-video">
                                <i class="fa-sharp fa-solid fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="why-shape-2 shape-mockup movingX d-none d-xxl-block" data-left="30%" data-bottom="16%"><img src="assets/img/shape/why-3-1.png" alt="Aalokbortika"></div>
    </section> <!--==============================
Testimonial Area  
==============================-->
    <section class="overflow-hidden testi-area3 space">
        <div class="shape-mockup testi-bg-shape3-1 jump-reverse d-xl-block d-none" data-right="10%" data-top="8%">
            <img src="assets/img/shape/shape8.png" alt="img">
        </div>
        <div class="shape-mockup testi-bg-shape3-1 spin d-xl-block d-none" data-left="4%" data-top="25%">
            <img src="assets/img/shape/instr-3-1.png" alt="img">
        </div>
        <div class="container th-container4 overflow-hidden">
            <div class="row justify-content-center align-items-center">
                <div class="col-xxl-3">
                    <div class="title-area text-center">
                        <span class="sub-title text-anim">TESTIMONIALS</span>
                        <h2 class="sec-title text-anim2">What they’re talking about Aalokbortika?</h2>
                    </div>
                </div>
            </div>
            <div class="row gx-0 gy-4">
                <div class="col-xl-8">
                    <div class="slider-area">
                        <div class="swiper th-slider testi-slider2" id="testiSlide2" data-slider-options='{"loop":false,"effect": "slide","thumbs":{"swiper":".testi-thumb-slider"}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testi-card2">
                                        <div class="box-quote"><img src="assets/img/icon/quote2.svg" alt=""></div>
                                        <p class="box-text">At Aalokbortika University, we prepare you to launch your career by providing a supportive, creative, and professional environment from which to learn practical skills and build a network of industry contacts. Ducamb welcomed every pain avoided but in certa mstances owing to the claims of igation that off bu will frequently occuthe</p>
                                        <div class="box-review">
                                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                                        </div>
                                        <h3 class="box-title">Maliha Alizabeth</h3>
                                        <p class="box-desig">Student</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card2">
                                        <div class="box-quote"><img src="assets/img/icon/quote2.svg" alt=""></div>
                                        <p class="box-text">At Aalokbortika University, we prepare you to launch your career by providing a supportive, creative, and professional environment from which to learn practical skills and build a network of industry contacts. Ducamb welcomed every pain avoided but in certa mstances owing to the claims of igation that off bu will frequently occuthe</p>
                                        <div class="box-review">
                                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                                        </div>
                                        <h3 class="box-title">David Ade Smith</h3>
                                        <p class="box-desig">Student</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card2">
                                        <div class="box-quote"><img src="assets/img/icon/quote2.svg" alt=""></div>
                                        <p class="box-text">At Aalokbortika University, we prepare you to launch your career by providing a supportive, creative, and professional environment from which to learn practical skills and build a network of industry contacts. Ducamb welcomed every pain avoided but in certa mstances owing to the claims of igation that off bu will frequently occuthe</p>
                                        <div class="box-review">
                                            <i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                                        </div>
                                        <h3 class="box-title">Jessica Lauren</h3>
                                        <p class="box-desig">Student</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button data-slider-prev="#testiSlide2" class="slider-arrow style-border slider-prev"><i class="far fa-arrow-left"></i></button>
                        <button data-slider-next="#testiSlide2" class="slider-arrow style-border slider-next"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="slider-area testi-thumb">
                        <div class="swiper th-slider testi-thumb-slider" id="testiSlide3" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"600":{"slidesPerView":"1","effect":"slide"},"768":{"slidesPerView":"3"}},"effect":"coverflow","coverflowEffect":{"rotate":"0","stretch":"250","depth":"215","modifier":"1"},"centeredSlides":"true","autoplay":false,"autoHeight": "true"}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testi-card2-img">
                                        <img class="testi-img" src="assets/img/testimonial/testimonial_1_1.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card2-img">
                                        <img class="testi-img" src="assets/img/testimonial/testimonial_1_2.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card2-img">
                                        <img class="testi-img" src="assets/img/testimonial/testimonial_1_3.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--==============================
Team Area  
==============================-->
    <section class="team-area space" id="instr-sec">
        <div class="instr-shape1 shape-mockup movingX d-none d-xl-block" data-right="14%" data-top="8%"><img src="assets/img/shape/cat-3-1.png" alt="Aalokbortika"></div>
        <div class="container th-container4">
            <div class="row justify-content-between">
                <div class="col-xxl-4 col-xl-9 col-lg-8 col-md-10">
                    <div class="title-area">
                        <span class="sub-title text-anim">INSTRUCTORS</span>
                        <h2 class="sec-title text-anim2">
                            Our Experienced <span class="text-theme">Instructors</span>
                        </h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn">
                        <div class="icon-box d-none d-lg-flex">
                            <button data-slider-prev="#teamSlider3" class="slider-arrow style3 default"><i class="far fa-arrow-left"></i></button>
                            <button data-slider-next="#teamSlider3" class="slider-arrow style3 default"><i class="far fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div class="swiper th-slider instr-slider1" id="teamSlider3" data-slider-options='{"breakpoints": {"0":{"slidesPerView": 1, "autoplay" : "true"},"768":{"slidesPerView": 2},
                    "992":{"slidesPerView": 3},"1299":   {"slidesPerView": 3},"1300":{"slidesPerView": 4}},"slidesPerView" : "4","spaceBetween": "24","loop": "true","autoplay" : "false"}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-1.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Kristin Watson</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-2.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Ralph Edwards</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-3.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Jerome Bell</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-4.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Leslie Alexander</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-5.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Priya Ray</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-6.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Ralph Edwards</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-7.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Jerome Bell</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="instr-card">
                                <div class="instr-img">
                                    <img src="assets/img/mentor/3-8.png" alt="Aalokbortika">
                                </div>
                                <div class="box-content">
                                    <a href="teacher.html" class="card-icon"><img src="assets/img/icon/right-icon-black.svg" alt="Aalokbortika" class="th-arrow"></a>
                                    <div class="media-body">
                                        <h3 class="box-title"><a href="teacher.html">Alisa Smith</a></h3>
                                        <span class="instr-desig">Teacher of Development</span>
                                    </div>
                                    <div class="th-social style3">
                                        <a target="_blank" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <div class="line"></div>
                                        <a target="_blank" href="https://linkedin.com/"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <span class="instr-shape2 shape-mockup spin d-none d-xl-block" data-right="4%" data-bottom="6%"><img src="assets/img/shape/instr-3-1.png" alt="Aalokbortika"></span>
    </section><!--==============================
Team Area  
==============================-->
    <section class="partners-area-1 position-relative overflow-hidden space overflow-hidden" id="partners-sec">
        <div class="container th-container4">
            <div class="row gx-70 align-items-center justify-content-center justify-content-xl-start">
                <div class="col-xxl-3 col-xl-4 col-lg-12">
                    <div class="title-area text-center text-xl-start mb-75">
                        <div class="title-wrap">
                            <span class="sub-title text-anim" data-cue="slideInLeft">PARTNERS</span>
                            <h2 class="sec-title text-anim2" data-cue="slideInUp"> Learn with our partners
                            </h2>
                        </div>
                        <p class="sec-text mb-0">At Aalokbortika University we are committed to providing a high-quality education</p>
                    </div>
                    <div class="btn-wrap justify-content-center justify-content-xl-start">
                        <a href="contact.html" class="th-btn th-icon">Start Learning</a>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8 col-lg-12">
                    <div class="partners-wrap1">
                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-1.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-2.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-3.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-4.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-5.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-6.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-7.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                        <div class="">
                            <div class="partners-card">
                                <a href="#" class="position-absolute">
                                    <img src="assets/img/partners/3-8.svg" alt="Aalokbortika">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="partners-shape1 shape-mockup jump d-none d-xl-block" data-right="0%" data-bottom="0%"><img src="assets/img/shape/partners-3-1.png" alt="Aalokbortika"></div>
    </section>
    <section class="community-area-2 overflow-hidden position-relative " id="community-sec">
        <div class="container th-container4">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="space">
                        <div class="title-area text-center text-xl-start">
                            <span class="sub-title text-anim">COMMUNITY</span>
                            <h2 class="sec-title text-anim2">Life long <span class="text-theme">learning</span> <span class="d-block">community</span></h2>
                            <p class="sec-text3 mt-25 wow fadeInUp" data-wow-delay=".3s">At Aalokbortika University we are
                                committed to providing a high-quality education that is accessible.</p>
                        </div>
                        <div class="community-wrap2">
                            <div class="community-card2 wow fadeInUp" data-wow-delay=".2s">
                                <div class="community-icon">
                                    <img src="assets/img/icon/communiti-3-1.svg" alt="Aalokbortika">
                                </div>
                                <div class="card-content">
                                    <h3 class="box-title">
                                        <a href="program-details.html">Exclusive Coach</a>
                                    </h3>
                                    <p class="box-text">We believe in the power of knowledge to transform</p>
                                </div>
                            </div>

                            <div class="community-card2 wow fadeInUp" data-wow-delay=".4s">
                                <div class="community-icon">
                                    <img src="assets/img/icon/communiti-3-2.svg" alt="Aalokbortika">
                                </div>
                                <div class="card-content">
                                    <h3 class="box-title">
                                        <a href="program-details.html">Creative Minds</a>
                                    </h3>
                                    <p class="box-text">We believe in the power of knowledge to transform</p>
                                </div>
                            </div>

                            <div class="community-card2 wow fadeInUp" data-wow-delay=".6s">
                                <div class="community-icon">
                                    <img src="assets/img/icon/communiti-3-3.svg" alt="Aalokbortika">
                                </div>
                                <div class="card-content">
                                    <h3 class="box-title">
                                        <a href="program-details.html">Video Tutorials</a>
                                    </h3>
                                    <p class="box-text">We believe in the power of knowledge to transform</p>
                                </div>
                            </div>

                            <div class="community-card2 wow fadeInUp" data-wow-delay=".8s">
                                <div class="community-icon">
                                    <img src="assets/img/icon/communiti-3-4.svg" alt="Aalokbortika">
                                </div>
                                <div class="card-content">
                                    <h3 class="box-title">
                                        <a href="program-details.html">Great Resources</a>
                                    </h3>
                                    <p class="box-text">We believe in the power of knowledge to transform</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="community-banner">
                        <img src="assets/img/community/3-1.jpg" alt="image">
                    </div>
                </div>
            </div>
        </div>
        <div class="community-shape1 shape-mockup jump d-none d-xxl-block" data-left="0%" data-bottom="0%"><img src="assets/img/shape/communiti-3-1.png" alt="Aalokbortika"></div>
    </section><!--==============================
Mentorship Area Home 3
==============================-->
    <section class="mentorship-area-1 position-relative overflow-hidden space">
        <div class="container th-container3">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8 col-md-8">
                    <div class="title-area">
                        <span class="sub-title text-anim">MENTORSHIP</span>
                        <h2 class="sec-title text-anim2">Read to Join?</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-24">
                <div class="col-lg-6">
                    <div class="mentorship-card">
                        <div class="mentorship-img global-img">
                            <img src="assets/img/mentorship/3-1.jpg" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title">
                                <a href="#">Become An Instructor</a>
                            </h3>
                            <p class="box-text">Top 20 courses among our 1350+ free online courses by experts</p>
                            <div class="btn-wrap justify-content-center">
                                <a href="contact.html" class="th-btn th-icon"> Get More Info</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mentorship-card">
                        <div class="mentorship-img global-img">
                            <img src="assets/img/mentorship/3-2.jpg" alt="Aalokbortika">
                        </div>
                        <div class="card-content">
                            <h3 class="box-title">
                                <a href="#">Access To Inclusive Education</a>
                            </h3>
                            <p class="box-text">Top 20 courses among our 1350+ free online courses by experts</p>
                            <div class="btn-wrap justify-content-center">
                                <a href="contact.html" class="th-btn th-icon"> Get More Info</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- <section class="banner-area-1  overflow-hidden">
        <div class="container th-container4">
            <div class="banner-wrap1">
                <div class="banner-left-img">
                    <img src="assets/img/banner/3-2.png" alt="Aalokbortika">
                </div>
                <div class="banner-content">
                    <h2 class="box-title">Let’s Find The Right Course For You!</h2>
                    <div class="btn-wrap mt-50">
                        <a href="#">
                            <img src="assets/img/theme-img/home-3-banner-download-1.svg" alt="Aalokbortika">
                        </a>
                        <a href="#">
                            <img src="assets/img/theme-img/home-3-banner-download-2.svg" alt="Aalokbortika">
                        </a>
                    </div>
                </div>
                <div class="banner-right-img">
                    <img src="assets/img/banner/3-3.png" alt="Aalokbortika">
                </div>
            </div>
        </div>
        <div class="shape-mockup d-none d-xl-block" data-bottom="0%" data-left="0%"><img src="assets/img/banner/3-1.png" alt="Aalokbortika"></div>
        <div class="shape-mockup" data-bottom="0%" data-right="3%"><img src="assets/img/shape/banner-3-1.png" alt="Aalokbortika">
        </div>
    </section> -->
    
    <!--==============================
Blog Area 3
==============================-->
    <section class="blog-arae-3 overflow-hidden space" id="blog-sec">
        <div class="blog-shape1 shape-mockup jump" data-top="30%" data-left="2%"><img src="assets/img/shape/instr-3-1.png" alt="Aalokbortika"></div>
        <div class="container th-container4">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-8 col-12">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim"> LATEST NEWS & BLOG </span>
                        <h2 class="sec-title text-anim2"> Get Latest <span class="text-theme">News</span> & Blog </h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".2s">
                        <a href="blog.html" class="th-btn style-border1 th-icon"> Explore All </a>
                    </div>
                </div>
            </div>

            <div class="slider-area">
                <div class="swiper th-slider has-shadow" id="blogSlider2" data-slider-options='{"autoplay": false,"breakpoints": {"0": {"slidesPerView": 1},"576": {"slidesPerView": "1"},
                         "768": {"slidesPerView": "1"},"992": {"slidesPerView": 2},"1299": {"slidesPerView": 3},"1400": {"slidesPerView": 3, "spaceBetween": "32"}},"autoHeight": "true"}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_1.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">24</h5>
                                        <p class="blog-date-text">june, 25</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">How Motivated When Learning Something New</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_2.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">29</h5>
                                        <p class="blog-date-text">june, 18</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">What's the Secret to Reading Books Effectively?</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_3.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">18</h5>
                                        <p class="blog-date-text">june, 25</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">Why Setting Goals Can Improve Your Learning Skills</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_1.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">24</h5>
                                        <p class="blog-date-text">june, 18</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">How to Stay Motivated When Learning Something New</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_2.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">29</h5>
                                        <p class="blog-date-text">june, 25</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">What's the Secret to Reading Books Effectively?</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_3.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">18</h5>
                                        <p class="blog-date-text">june, 18</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">Why Setting Goals Can Improve Your Learning Skills</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_1.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">24</h5>
                                        <p class="blog-date-text">june, 25</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">How to Stay Motivated When Learning Something New</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education.</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide fadeinup wow">
                            <div class="blog-card blog-card2">
                                <div class="blog-img2 position-relative">
                                    <a href="blog-details.html">
                                        <div class="blog-img-box2 position-relative">
                                            <img src="assets/img/blog/blog_3_2.jpg" alt="blog image">
                                        </div>
                                    </a>
                                    <div class="blog-date">
                                        <h5 class="blog-date-title">29</h5>
                                        <p class="blog-date-text">june, 18</p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <a class="author" href="blog.html">
                                            <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>
                                            By themeholy
                                        </a>
                                        <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment </a>
                                    </div>
                                    <h3 class="box-title"><a href="blog-details.html">What's the Secret to Reading Books Effectively?</a></h3>
                                    <p class="box-text">At Aalokbortika University we are committed to providing a high-quality education</p>
                                    <div class="btn-wrap">
                                        <a href="blog-details.html" class="th-btn th-icon style-border1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="blog-shape2 shape-mockup jump" data-right="2%" data-bottom="0%"><img src="assets/img/shape/blog-3-1.png" alt="Aalokbortika"></div>
    </section><!--==============================
Marquee Area  
==============================-->
    <div class="marquee-area space-bottom  overflow-hidden">
        <div class="container-fluid p-0">
            <div class="swiper th-slider marquee-slider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":"auto"}},"autoplay":{"delay":0,"disableOnInteraction":false},"noSwiping":"true","speed":10000,"spaceBetween":40}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/open-book.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">CREATION</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/scollarship.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">DISCOVER</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/open-book.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">INNOVATE</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/open-book.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">EDUCATION</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/scollarship.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">CASE STUDIES</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/open-book.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">CREATION</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/open-book.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">DISCOVER</a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="marquee-card">
                            <div class="color-masking">
                                <img src="assets/img/icon/scollarship.svg" alt="icon">
                            </div>
                            <a target="_blank" href="#">INNOVATE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--==============================
Contact Area   
==============================-->
    <div class="space contact-area-1 position-relative z-index-common" id="contact-sec">
        <div class="container th-container4">
            <div class="row gx-0 gy-40">
                <div class="col-lg-6">
                    <!--==============================
Contact Area  
==============================-->
                    <div class="contact-form-v1 ">
                        <form action="mail.php" method="POST" class="contact-form2 ajax-contact">
                            <div class="title-area mb-60">
                                <span class="sub-title">GET IN TOUCH</span>
                                <h2 class="sec-title">Do you have questions?</h2>
                            </div>
                            <div class="row">
                                <div class="form-group style-border col-md-6">
                                    <input type="text" class="form-control" name="firstname" id="firstname2" placeholder="name*">
                                </div>
                                <div class="form-group style-border col-md-6">
                                    <input type="number" class="form-control" name="number" id="number2" placeholder="Phone*">
                                </div>
                                <div class="form-group style-border col-12">
                                    <input type="email" class="form-control" name="email" id="email2" placeholder="e-mail address*">
                                </div>
                                <div class="form-group style-border col-12">
                                    <select name="subject" id="subject" class="form-select">
                                        <option value="" disabled selected hidden>Subject</option>
                                        <option value="Computer Seince">Computer Seince</option>
                                        <option value="Astrophysics">Astrophysics</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                        <option value="Data Science">Data Science</option>
                                    </select>
                                </div>
                                <div class="form-group style-border col-12">
                                    <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Write your message*"></textarea>
                                </div>
                                <div class="form-btn col-12 mt-15">
                                    <button class="th-btn">Send Message</button>
                                </div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-img">
                        <img src="assets/img/normal/contact-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-wrapper footer-layout3" data-bg-src="{{ asset('assets/img/bg/footer-bg-2.png') }}">
        <div class="copyright-wrap z-index-common">
            <div class="container th-container4">
                <div class="row justify-content-center gy-3 align-items-center">
                    <div class="col-md-7">
                        <p class="copyright-text">
                            <i class="fal fa-copyright"></i> Copyright 2025 <a href="#">Aalokbortika</a>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-5 text-md-end text-center">
                        <div class="th-social">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--********************************
			Code End  Here 
	******************************** -->

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>
    <!--==============================
    modal Area  
    ==============================-->
    <div id="login-form" class="popup-login-register mfp-hide">
        <ul class="nav" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-menu active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-menu" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Register</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> 
                        <h3 class="box-title mb-30">Sign in to your account</h3>

                        <div class="th-login-form">

                            <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf

                                <div class="row">

                                    <!-- Email -->
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            id="email" 
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror" 
                                            required 
                                            autofocus
                                        >
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group col-12 mt-3">
                                        <label>Password</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            id="password" 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            required
                                        >
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group col-12 mt-2">
                                        <label class="inline-flex align-items-center">
                                            <input 
                                                id="remember_me" 
                                                type="checkbox" 
                                                name="remember"
                                                class="me-2"
                                            >
                                            Remember me
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-btn mb-20 col-12 mt-3">
                                        <button class="th-btn btn-fw th-radius2">Log In</button>
                                    </div>
                                </div>

                                <!-- Forgot Password -->
                                @if (Route::has('password.request'))
                                <div id="forgot_url">
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                                @endif

                            </form>

                        </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="th-form-title mb-30">Sign in to your account</h3>
                <form method="POST" action="{{ route('register') }}" class="login-form">
                    @csrf

                    <div class="row">

                        <!-- Name -->
                        <div class="form-group col-12">
                            <label>Name*</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group col-12">
                            <label>Email*</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group col-12">
                            <label>Password*</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group col-12">
                            <label>Confirm Password*</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Login redirect -->
                        <div class="col-12 mt-2">
                            <a href="{{ route('login') }}" class="text-sm">Already registered?</a>
                        </div>

                        <!-- Submit button -->
                        <div class="form-btn mt-20 col-12">
                            <button type="submit" class="th-btn btn-fw th-radius2">Sign up</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
    <!-- Swiper Js -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up -->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Range Slider -->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Isotope Filter -->
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- Wow Js -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>

    <!-- Gsap Animation -->
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <!-- ScrollTrigger -->
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <!-- SplitText -->
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>


    <!-- Lenis Js -->
    <!-- <script src="{{ asset('assets/js/lenis.min.js') }}"></script> -->

    
    <!-- Main Js File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>