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
    <title>Shared By NULLPHPSCRIPT.COM - Aalokbortika - University Education HTML Template - Home One</title>
    <meta name="author" content="Aalokbortika">
    <meta name="description" content="Aalokbortika - University Education HTML Template">
    <meta name="keywords" content="Aalokbortika - University Education HTML Template">
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

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

    <!--==============================
     Preloader
  ==============================-->
    <div class="preloader ">
        <button class="th-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <img src="assets/img/logo-icon.svg" alt="img">
            <span class="loader">
                Aalokbortika
                <span class="loading-text">Aalokbortika</span>
            </span>
        </div>
    </div><!--==============================
    Sidemenu
============================== -->
    <div class="sidemenu-wrapper ">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <div class="widget footer-widget">
                <div class="th-widget-about">
                    <div class="about-logo">
                        <a href="home-university.html">
                            <img src="assets/img/logo2.svg" alt="Aalokbortika">
                        </a>
                    </div>
                    <p class="about-text">Since 1999, when the newly minted Aalokbortika team embraced its mandate to breathe new life into the downtrodden neighbourhood, East Village’s transformation has been nothing short of remarkable. </p>
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
                            <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a>
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
                            <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-2.jpg" alt="Blog Image"></a>
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
                            <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-3.jpg" alt="Blog Image"></a>
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
                <a href="#"><img src="assets/img/logo.png" alt="Aalokbortika"></a>
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
    </div>
    <!--==============================
	Header Area
==============================-->
    <header class="th-header header-layout1">
        <div class="header-top">
            <div class="container th-container4">
                <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                    <div class="col-auto d-none d-lg-block">
                        <div class="header-links">
                            <ul class="header-left-wrap">
                                <li>
                                    <div class="dropdown-link">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"> Studients</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <li>
                                                <a href="#">Scrollship</a>
                                                <a href="#">Forening</a>
                                                <a href="#">Online</a>
                                                <a href="#">Bysexual</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="contact.html">Staff</a></li>
                                <li><a href="alumni.html">Alumni</a></li>
                                <li><a href="faculty.html">Faculty</a> </li>
                                <li><a href="contact.html">Community</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-links">
                            <ul class="header-right-wrap">
                                <li><i class="fa-solid fa-user"></i><a href="#login-form" class="popup-content">Login / Register</a></li>
                                <li><i class="fas fa-comments"></i><a href="faq.html">FAQ</a></li>
                                <li>
                                    <div class="dropdown-link">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/img/icon/lang.svg" alt=""> </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
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
        </div>
        <div class="header-info d-none d-sm-block">
            <div class="container th-container2">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="header-logo">
                            <a href="#">
                                <img src="assets/img/logo.png" style="width:250px !important;" alt="Aalokbortika">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-info-right">
                            <div class="header-info-item">
                                <div class="header-info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="header-info-content">
                                    <span class="header-info-text">Address</span>
                                    <h3 class="header-info-title">
                                        <a href="#">45 New Eskaton Road, Austria</a>
                                    </h3>
                                </div>
                            </div>
                            <div class="header-info-item">
                                <div class="header-info-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="header-info-content">
                                    <span class="header-info-text">Email</span>
                                    <h3 class="header-info-title">
                                        <a href="tel:mailinfo@example.com">mailinfo@example.com</a>
                                    </h3>
                                </div>
                            </div>
                            <div class="header-info-item">
                                <div class="header-info-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="header-info-content">
                                    <span class="header-info-text">Phone Number</span>
                                    <h3 class="header-info-title">
                                        <a href="tel:+0112345678900">+01 123 456 789 00</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container th-container2">
                    <div class="menu-wrapp">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">
                                <div class="header-left d-flex align-items-center">
                                    <div class="header-logo d-block d-sm-none">
                                        <a href="home-university.html">
                                            <img src="assets/img/logo.png" style="width:250px !important;" alt="Aalokbortika">
                                        </a>
                                    </div>
                                    <div class="header-button d-none d-sm-block">
                                        <a href="contact.html" class="th-btn">
                                            Get More Info
                                            <img src="assets/img/icon/right-icon.svg" class="th-arrow" alt="icon">
                                        </a>
                                    </div>
                                    <nav class="main-menu d-none d-xl-block">
                                        <ul>
                                            <li class="menu-item-has-children">
                                                <a href="home-university.html">Home</a>
                                                <ul class="mega-menu mega-menu-content mega-scroll">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-4">
                                                                    <div class="mega-menu-box">
                                                                        <div class="mega-menu-img">
                                                                            <img src="assets/img/pages/home-university.jpg" alt="Home One">
                                                                            <div class="btn-wrap">
                                                                                <a href="home-university.html" class="th-btn">Multipage</a>
                                                                                <a href="home-university-op.html" class="th-btn">Onepage</a>
                                                                            </div>
                                                                        </div>
                                                                        <h3 class="mega-menu-title"><a href="home-university.html">Home University</a></h3>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mega-menu-box">
                                                                        <div class="mega-menu-img">
                                                                            <img src="assets/img/pages/home-admission.jpg" alt="Home Two">
                                                                            <div class="btn-wrap">
                                                                                <a href="home-admission.html" class="th-btn">Multipage</a>
                                                                                <a href="home-admission-op.html" class="th-btn">Onepage</a>
                                                                            </div>
                                                                        </div>
                                                                        <h3 class="mega-menu-title"><a href="home-admission.html">Home Admission</a></h3>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="mega-menu-box">
                                                                        <div class="mega-menu-img">
                                                                            <img src="assets/img/pages/home-courses.jpg" alt="Home Three">
                                                                            <div class="btn-wrap">
                                                                                <a href="home-courses.html" class="th-btn">Multipage</a>
                                                                                <a href="home-courses-op.html" class="th-btn">Onepage</a>
                                                                            </div>
                                                                        </div>
                                                                        <h3 class="mega-menu-title"><a href="home-courses.html">Home Courses</a>
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
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
                                    </nav>
                                </div>
                            </div>
                            <div class="col-auto ms-lg-auto">
                                <div class="header-button">
                                    <form class="search-form">
                                        <input type="text" placeholder="Search...">
                                        <button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
                                    </form>
                                    <a href="#" class="icon-btn sideMenuToggler d-none d-xl-block"><img src="assets/img/icon/grid2.svg" alt=""></a>

                                    <button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!--==============================
Hero Area
==============================-->
    <div class="th-hero-wrapper hero-1" id="hero">
        <div class="swiper th-slider" id="heroSlide" data-slider-options='{"effect":"fade"}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-inner">
                        <div class="th-hero-bg" data-bg-src="assets/img/hero/hero_1_1.jpg"></div>
                        <div class="container th-container2">
                            <div class="row gy-60 align-items-center">
                                <div class="col-xxl-6 col-xl-8 col-lg-9">
                                    <div class="hero-style1">
                                        <div class="hero-text-wrap">
                                            <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">
                                                Welcome To The Aalokbortika University
                                            </h1>
                                            <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">
                                                We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                            <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.8s">
                                                <a href="contact.html" class="th-btn white-hover th-icon"> Admission Now</a>
                                                <a href="program.html" class="th-btn style-border1 th-icon white-hover">View Program</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-3">
                                    <div class="hero-video text-center ms-xl-5 ps-xl-5" data-ani="fadeinright" data-ani-delay="0.9s">
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
                        <div class="th-hero-bg" data-bg-src="assets/img/hero/hero_1_2.jpg"></div>
                        <div class="container th-container2">
                            <div class="row gy-60 align-items-center">
                                <div class="col-xxl-6 col-xl-8 col-lg-9">
                                    <div class="hero-style1">
                                        <div class="hero-text-wrap">
                                            <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">
                                                Shaping the Leaders of Tomorrow
                                            </h1>
                                            <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">
                                                We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                            <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.8s">
                                                <a href="contact.html" class="th-btn white-hover th-icon"> Admission Now</a>
                                                <a href="program.html" class="th-btn style-border1 th-icon white-hover">View Program</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-3">
                                    <div class="hero-video text-center ms-xl-5 ps-xl-5" data-ani="fadeinright" data-ani-delay="0.9s">
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
                        <div class="th-hero-bg" data-bg-src="assets/img/hero/hero_1_1.jpg"></div>
                        <div class="container th-container2">
                            <div class="row gy-60 align-items-center">
                                <div class="col-xxl-6 col-xl-8 col-lg-9">
                                    <div class="hero-style1">
                                        <div class="hero-text-wrap">
                                            <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">
                                                Where Innovation Meets Education
                                            </h1>
                                            <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">
                                                We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                            <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.8s">
                                                <a href="contact.html" class="th-btn white-hover th-icon"> Admission Now</a>
                                                <a href="program.html" class="th-btn style-border1 th-icon white-hover">View Program</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-3">
                                    <div class="hero-video text-center ms-xl-5 ps-xl-5" data-ani="fadeinright" data-ani-delay="0.9s">
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
                        <div class="th-hero-bg" data-bg-src="assets/img/hero/hero_1_2.jpg"></div>
                        <div class="container th-container2">
                            <div class="row gy-60 align-items-center">
                                <div class="col-xxl-6 col-xl-8 col-lg-9">
                                    <div class="hero-style1">
                                        <div class="hero-text-wrap">
                                            <h1 class="hero-title text-white" data-ani="slideinup" data-ani-delay="0.3s">
                                                Welcome To The Aalokbortika University
                                            </h1>
                                            <p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">
                                                We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                            <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.8s">
                                                <a href="contact.html" class="th-btn white-hover th-icon"> Admission Now</a>
                                                <a href="program.html" class="th-btn style-border1 th-icon white-hover">View Program</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-3">
                                    <div class="hero-video text-center ms-xl-5 ps-xl-5" data-ani="fadeinright" data-ani-delay="0.9s">
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
            <div class="slider-pagination"></div>
        </div>
    </div>
    <!--======== / Hero Section ========-->
    <div class="feature-sec-1 position-relative overflow-hidden space-bottom">
        <div class="about-shep-2 shape-mockup  d-none d-xxl-block" data-top="19%" data-left="0%">
            <img src="assets/img/shape/feature-shep-home-1.png" alt="shape">
        </div>
        <div class="container th-container2">
            <div class="row gx-10 gy-10">
                <div class="col-xl-3 col-md-6 feature-card_wrapp">
                    <div class="feature-card wow fadeInUp" data-wow-delay=".2s">
                        <div class="box-icon">
                            <img src="assets/img/icon/feature-icon1-1.svg" alt="icon">
                        </div>
                        <h3 class="box-title">University Life</h3>
                        <p class="box-text style2">On the other hand denounce with righteous indignation dislike.</p>
                        <a href="program.html" class="th-btn style-border2 th-icon">Learn More</a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 feature-card_wrapp">
                    <div class="feature-card wow fadeInUp" data-wow-delay=".4s">
                        <div class="box-icon">
                            <img src="assets/img/icon/feature-icon1-2.svg" alt="icon">
                        </div>
                        <h3 class="box-title">Research</h3>
                        <p class="box-text style2">On the other hand denounce with righteous indignation dislike.</p>
                        <a href="program.html" class="th-btn style-border2 th-icon">Learn More</a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 feature-card_wrapp">
                    <div class="feature-card wow fadeInUp" data-wow-delay=".6s">
                        <div class="box-icon">
                            <img src="assets/img/icon/feature-icon1-3.svg" alt="icon">
                        </div>
                        <h3 class="box-title">Athletics</h3>
                        <p class="box-text style2">On the other hand denounce with righteous indignation dislike.</p>
                        <a href="program.html" class="th-btn style-border2 th-icon">Learn More</a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 feature-card_wrapp">
                    <div class="feature-card wow fadeInUp" data-wow-delay=".8s">
                        <div class="box-icon">
                            <img src="assets/img/icon/feature-icon1-4.svg" alt="icon">
                        </div>
                        <h3 class="box-title">Academics</h3>
                        <p class="box-text style2">On the other hand denounce with righteous indignation dislike.</p>
                        <a href="program.html" class="th-btn style-border2 th-icon">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
About Area  
==============================-->
    <div class="about1-area position-relative overflow-hidden space-bottom" id="about-sec">
        <div class="about-shep-2 shape-mockup d-none d-xxl-block" data-bottom="0%" data-right="0%">
            <img src="assets/img/shape/feature-shep-2-home-1.png" alt="shape">
        </div>
        <span class="about-shape-right shape-mockup jump-reverse" data-right="3%" data-top="2%"><img src="assets/img/shape/ab-shape1-2.png" alt=""></span>
        <div class="container">
            <div class="about-wrap1 position-relative z-index-2">
                <div class="row gy-60 align-items-center justify-content-center">
                    <div class="col-xl-6">
                        <div class="img-box1">
                            <div class="img1 text-center text-sm-start wow fadeInLeft" data-wow-delay=".2s">
                                <img src="assets/img/about/home-1-about-thumb1-1.jpg" alt="About">
                            </div>
                            <div class="img2 wow fadeInUp" data-wow-delay=".3s">
                                <div class="position-relative">
                                    <img class="mb-25" src="assets/img/about/home-1-about-thumb1-2.jpg" alt="About">
                                </div>
                                <div class="position-relative wow fadeInUp" data-wow-delay=".3s">
                                    <img src="assets/img/about/home-1-about-thumb1-3.jpg" alt="About">
                                </div>
                            </div>
                            <div class="about-wrapp">
                                <div class="discount-wrapp">
                                    <div class="logo">
                                        <img src="assets/img/circle-logo.png" alt="img">
                                    </div>
                                    <div class="discount-tag">
                                        <span class="discount-anime">* 1996 EST * 25 Years Quality Teaching</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-content ms-xxl-4 ps-xxl-2 ms-xl-2">
                            <div class="title-area">
                                <span class="sub-title text-anim">About Us</span>
                                <h2 class="sec-title text-anim2"> We Offer best program for Shaping the best Future
                                </h2>

                                <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">We are committed
                                    to leaving the world a better place. We pursue new technology, encourage
                                    creativity, engage
                                    with our communities, and share an entrepreneurial mindset.</p>
                            </div>
                            <div class="about-feature-box">
                                <div class="about-feature wow fadeInUp" data-wow-delay=".3s">
                                    <span class="box-icon">
                                        <img src="assets/img/icon/ab-users.svg" alt="icon">
                                    </span>
                                    <div class="box-content">
                                        <h3 class="box-title">Three MBA degrees</h3>
                                        <p class="box-text">Our team is ready for any challenge! We put our joint efforts to
                                            generate brave business ideas.</p>
                                    </div>
                                </div>
                                <div class="about-feature wow fadeInUp" data-wow-delay=".4s">
                                    <span class="box-icon">
                                        <img src="assets/img/icon/ab-message.svg" alt="icon">
                                    </span>
                                    <div class="box-content">
                                        <h3 class="box-title">Choose From 98+ Degrees</h3>
                                        <p class="box-text">Our team is ready for any challenge! We put our joint efforts to
                                            generate brave business ideas.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrap wow fadeInUp" data-wow-delay=".5s">
                                <a href="about.html" class="th-btn th-icon">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="about-shape-left shape-mockup movingX d-none d-xxl-block" data-bottom="0%" data-left="2%"><img src="assets/img/shape/ab-shape1-1.png" alt=""></span>
    </div>
    <div class="counter-area1 overflow-hidden ">
        <div class="container th-container2">
            <div class="counter-wrap1">
                <div class="counter-card wow fadeInUp" data-wow-delay=".2s">
                    <div class="box-icon">
                        <img src="assets/img/icon/counter-icon1-1.svg" alt="icon">
                    </div>
                    <div class="media-body">
                        <h3 class="box-number"><span class="counter-number">157</span>+</h3>
                        <p class="box-text">Total Programs</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card wow fadeInUp" data-wow-delay=".4s">
                    <div class="box-icon">
                        <img src="assets/img/icon/counter-icon1-2.svg" alt="icon">
                    </div>
                    <div class="media-body">
                        <h3 class="box-number"><span class="counter-number">18,250</span></h3>
                        <p class="box-text">Faculty & Staff</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card wow fadeInUp" data-wow-delay=".6s">
                    <div class="box-icon">
                        <img src="assets/img/icon/counter-icon1-3.svg" alt="icon">
                    </div>
                    <div class="media-body">
                        <h3 class="box-number"><span class="counter-number">48</span>k</h3>
                        <p class="box-text">Worldwide Alumni</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card wow fadeInUp" data-wow-delay=".7s">
                    <div class="box-icon">
                        <img src="assets/img/icon/counter-icon1-4.svg" alt="icon">
                    </div>
                    <div class="media-body">
                        <h3 class="box-number"><span class="counter-number">155</span>k</h3>
                        <p class="box-text">Total Students</p>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>
    <section class="academic1-area space overflow-hidden" id="program-sec">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-9 col-12">
                    <div class="title-area text-center text-lg-start mb-75">
                        <span class="sub-title text-anim">ACADEMICS</span>
                        <h2 class="sec-title text-anim2">We have the best programs for you</h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".3s">
                        <a href="program.html" class="th-btn style-border1 th-icon"> Explore All </a>
                    </div>
                </div>
            </div>
            <div class="academic-wrapp">
                <div class="slider-area">
                    <div class="swiper th-slider has-shadow" id="academicSlider2" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"3", "spaceBetween": "24"}},"autoHeight": "true", "autoplay" : "false"}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-1.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Media</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Applied Mathematics</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> English
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-2.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Science</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Applied Architecture</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> Arabic
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-3.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Public</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Administration Cse</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> Hindi
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-1.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Education</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Applied Mathematics</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> English
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-2.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Education</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Applied Architecture</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> Arabic
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="academic-card">
                                    <div class="academic-img">
                                        <a href="program-details.html">
                                            <img src="assets/img/academic/academic1-3.jpg" alt="blog image">
                                        </a>
                                        <div class="academic-tag">
                                            <span><i class="fa-solid fa-tags"></i> Education</span>
                                        </div>
                                    </div>
                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="program-details.html">Bachelor in Administration Cse</a>
                                        </h3>
                                        <div class="academic-review">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <p class="review-text">(4.8)</p>
                                        </div>
                                        <p class="box-text style2">Every traditional undergraduate student receives scholarships. Rest assured you can afford us too.</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <div class="academic-meta">
                                            <a href="program-details.html" class="subject">
                                                <i class="fa-solid fa-messages"></i> Hindi
                                            </a>
                                            <a href="#" class="duration"><i class="fa-solid fa-clock"></i> 04 Years</a>
                                        </div>
                                        <a href="program-details.html" class="th-btn style-border1 th-icon">Discover</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="why-area why-bg position-relative space overflow-hidden">
        <div class="why-shape jump shape-mockup" data-left="0%" data-bottom="10%">
            <img src="assets/img/shape/why-1-1.png" alt="">
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-8">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim">WHY CHOOSEUS</span>
                        <h2 class="sec-title text-anim2">We help every student to <span class="d-block"> stantout from the
                                rest</span></h2>
                    </div>
                    <div class="row gy-60">
                        <!--==============================
Why Choose Us Area  
==============================-->
                        <div class="col-lg-6 col-md-6">
                            <div class="why-card wow fadeInUp" data-wow-delay=".2s">
                                <div class="why-content">
                                    <div class="why-titlebox">
                                        <span class="why-number position-relative">1</span>
                                        <h3 class="box-title">
                                            <a href="about.html">Get a Top-Tier Global Education</a>
                                        </h3>
                                    </div>
                                    <div class="box-text-wrap">
                                        <p class="box-text">A Kingdom perspective is integrated into your studies and woven through the entire Aalokbortika experience.</p>
                                    </div>
                                </div>
                                <a href="about.html" class="th-btn style-border1 th-icon mt-40">Explore More</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="why-card wow fadeInUp" data-wow-delay=".4s">
                                <div class="why-content">
                                    <div class="why-titlebox">
                                        <span class="why-number position-relative">2</span>
                                        <h3 class="box-title">
                                            <a href="about.html">Join a Spiritually Vibrant Campus Community</a>
                                        </h3>
                                    </div>
                                    <div class="box-text-wrap">
                                        <p class="box-text">Opportunities for faith and fellowship are all around, from chapel worship and dorm devotions to communal meals, clubs and activities.</p>
                                    </div>
                                </div>
                                <a href="about.html" class="th-btn style-border1 th-icon mt-40">Explore More</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="why-card wow fadeInUp" data-wow-delay=".6s">
                                <div class="why-content">
                                    <div class="why-titlebox">
                                        <span class="why-number position-relative">3</span>
                                        <h3 class="box-title">
                                            <a href="about.html">Be Prepared for a Thriving Career</a>
                                        </h3>
                                    </div>
                                    <div class="box-text-wrap">
                                        <p class="box-text">A Kingdom perspective is integrated into your studies and woven through the entire Aalokbortika experience.</p>
                                    </div>
                                </div>
                                <a href="about.html" class="th-btn style-border1 th-icon mt-40">Explore More</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="why-card wow fadeInUp" data-wow-delay=".8s">
                                <div class="why-content">
                                    <div class="why-titlebox">
                                        <span class="why-number position-relative">4</span>
                                        <h3 class="box-title">
                                            <a href="about.html">Experience a Cost-Competitive Education</a>
                                        </h3>
                                    </div>
                                    <div class="box-text-wrap">
                                        <p class="box-text">Opportunities for faith and fellowship are all around, from chapel worship and dorm devotions to communal meals, clubs and activities.</p>
                                    </div>
                                </div>
                                <a href="about.html" class="th-btn style-border1 th-icon mt-40">Explore More</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="why-video">
                        <div class="why-video-bg overflow-hidden gsap-parallax">
                            <img src="assets/img/why/why-video1-1.jpg" alt="image">
                            <div class="why-video-btn">
                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn popup-video">
                                    <i class="fa-sharp fa-solid fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="campus overflow-hidden space">
        <div class="campus-shape jump shape-mockup  d-none d-xxl-block" data-bottom="22%" data-right="5%">
            <img src="assets/img/shape/campus-1-1.png" alt="shape">
        </div>
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-8 col-12">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim">EXPERIENCE Aalokbortika</span>
                        <h2 class="sec-title text-anim2">Campus Life</h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn">
                        <a href="campus.html" class="th-btn style-border1 th-icon wow fadeInUp" data-wow-delay=".2s"> Explore All</a>
                    </div>
                </div>
            </div>
            <div class="row gy-5 justify-content-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="campus-card wow fadeInLeft" data-wow-delay=".2s">
                        <div class="campus-img global-img">
                            <a href="campus.html" class="d-block position-relative">
                                <img src="assets/img/campus/campus-1-1.jpg" alt="campus image" class="img-1">
                            </a>
                        </div>
                        <div class="campus-content">
                            <h3 class="box-title">
                                <a href="campus.html">Mentor Lecture</a>
                            </h3>
                            <p class="box-text">Schedule a personalized tour of our Ancaster, Ontario campus and a one-on-one meeting with an Admissions Counsellor. Daily visits are offered regularly to accommodate your schedule.</p>
                        </div>
                        <a href="campus.html" class="th-btn style-border1 th-icon">View The Campus</a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6">
                    <div class="campus-card wow fadeInLeft" data-wow-delay=".4s">
                        <div class="campus-img global-img">
                            <a href="campus.html" class="d-block position-relative">
                                <img src="assets/img/campus/campus-1-2.jpg" alt="campus image" class="img-1">
                            </a>
                        </div>
                        <div class="campus-content">
                            <h3 class="box-title">
                                <a href="campus.html">Group Study in Campus</a>
                            </h3>
                            <p class="box-text">Our scheduled visits are pre-planned days that are specially catered to the different interests of each student. Tour campus and connect with staff, faculty and current students to help discover your place.</p>
                        </div>
                        <a href="campus.html" class="th-btn style-border1 th-icon">View The Campus</a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6">
                    <div class="campus-card wow fadeInLeft" data-wow-delay=".6s">
                        <div class="campus-img global-img">
                            <a href="campus.html" class="d-block position-relative">
                                <img src="assets/img/campus/campus-1-3.jpg" alt="campus image" class="img-1">
                            </a>
                        </div>
                        <div class="campus-content">
                            <h3 class="box-title">
                                <a href="campus.html">Art & Culture</a>
                            </h3>
                            <p class="box-text">Can’t make it to campus? Explore parts of Redeemer’s 70-acre campus through a series of short videos and get a glimpse of what it has to offer—wherever and whenever works best for you.</p>
                        </div>
                        <a href="campus.html" class="th-btn style-border1 th-icon">View The Campus</a>
                    </div>
                </div>

            </div>
        </div>
    </section><!--==============================
Story Area  
==============================-->
    <div class="story-area-1 overflow-hidden">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-8 col-12">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim">STUDENT STORIES</span>
                        <h2 class="sec-title text-anim2">Our Student Stories</h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".3s">
                        <a href="program.html" class="th-btn style-border1 th-icon"> Discover More Stories </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="swiper th-slider story-slider1" id="storySlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"1400":{"slidesPerView":"5"},"1200":{"slidesPerView":"4"},"992":{"slidesPerView":"4"},"768":{"slidesPerView":"3"},"576":{"slidesPerView":"2"}},"spaceBetween":"0"}'>
                <div class="swiper-wrapper">
                    <!--==============================
Story Area  
==============================-->
                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-1.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-1.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-2.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Brone Due</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Brone Due</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-2.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Brone Due</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Brone Due</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-3.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Moumita Mira</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Moumita Mira</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-3.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Moumita Mira</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Moumita Mira</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-4.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Maya Lily</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Maya Lily</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-4.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Maya Lily</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Maya Lily</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-5.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Sony & Ovi</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Sony & Ovi</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-5.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Sony & Ovi</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Sony & Ovi</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-1.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-1.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-2.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Brone Due</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Brone Due</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-2.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Brone Due</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Brone Due</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-3.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Moumita Mira</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Moumita Mira</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-3.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Moumita Mira</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Moumita Mira</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-4.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Maya Lily</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Maya Lily</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-4.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Maya Lily</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Maya Lily</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-5.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Sony & Ovi</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Sony & Ovi</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-5.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Sony & Ovi</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Sony & Ovi</a>
                    </h3>
                </div>
            </div> -->

                    <div class="swiper-slide">
                        <div class="story-card">
                            <div class="box-img">
                                <img src="assets/img/story/story-1-1.jpg" alt="img">
                            </div>
                            <div class="story-content">

                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                            <div class="story-content hover-style">
                                <div class="quote-icon">
                                    <img src="assets/img/icon/quote.svg" alt="">
                                </div>
                                <p class="box-text">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                                <h3 class="box-title"><a href="program.html">Alex Smith</a></h3>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="story-card">
                <div class="story-thumb">
                    <img src="assets/img/story/story-1-1.jpg" alt="Icon">
                </div>
                <div class="story-content text-center">
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
                <div class="story-content hover-style text-center">
                    <span class="quote-icon">
                        <img src="assets/img/icon/quote.svg" alt="">
                    </span>
                    <p class="box-text text-white">"Aalokbortika University’s humanities program is helping me develop the perspective, critical thinking and adaptability I need to navigate and contribute to this changing world."</p>
                    <h3 class="box-title text-white">
                        <a href="program.html">Alex Smith</a>
                    </h3>
                </div>
            </div> -->

                </div>
            </div>
        </div>
    </div><!--==============================
Event Area 1
==============================-->
    <section class="event-area-1 position-relative overflow-hidden space" id="event-sec">
        <div class="event-shape shape-mockup d-none d-xxl-block" data-top="0%" data-left="0%">
            <img src="assets/img/shape/shape-2.png" alt="">
        </div>
        <div class="event-shape jump shape-mockup  d-none d-xxl-block" data-bottom="0%" data-left="3%">
            <img src="assets/img/shape/event-1-1.png" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-8 col-12">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim">STUDENT EVENTS</span>
                        <h2 class="sec-title text-anim2">Alumni Events</h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".3s">
                        <a href="event.html" class="th-btn style-border1 th-icon">Explore All</a>
                    </div>
                </div>
            </div>
            <div class="event-card-wrap">
                <div class="event-card wow fadeInUp" data-wow-delay=".2s">
                    <div class="event-card-img global-img">
                        <img src="assets/img/event/event-1-1.jpg" alt="event">
                        <p class="event-card-tag"><span class="tag-number">12</span>Jan</p>
                    </div>
                    <div class="event-content">
                        <div class="event-wrapp">
                            <h3 class="box-title text-anim2"><a href="event-details.html">Programming languages for a better world</a></h3>
                            <p class="box-text">Come for a quick session on how this question has crucially helped humanity with achieving one of its most impressive feats yet: orchestrating electric currents.</p>
                            <div class="blog-meta">
                                <a class="location" href="#">
                                    <i class="fa-solid fa-location-dot"></i>
                                    25 Circular Road, New York City </a>
                                <a class="date" href="#">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    25.02.2025 </a>
                                <a class="time" href="#">
                                    <i class="fa-solid fa-clock"></i>
                                    09:00am - 12:00pm </a>
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <a class="th-btn style-border1 th-icon" href="event-details.html">Details</a>
                        </div>
                    </div>
                </div>

                <div class="event-card wow fadeInUp" data-wow-delay=".4s">
                    <div class="event-card-img global-img">
                        <img src="assets/img/event/event-1-2.jpg" alt="event">
                        <p class="event-card-tag"><span class="tag-number">07</span>Feb</p>
                    </div>
                    <div class="event-content">
                        <div class="event-wrapp">
                            <h3 class="box-title text-anim2"><a href="event-details.html">Center for Subjectivity Research 2024</a></h3>
                            <p class="box-text">Center for subjectivity research at the university of copenhagen was established in 2002 on the basis of a grant from national research.</p>
                            <div class="blog-meta">
                                <a class="location" href="#">
                                    <i class="fa-solid fa-location-dot"></i>
                                    25 Circular Road, New York City </a>
                                <a class="date" href="#">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    03.08.2025 </a>
                                <a class="time" href="#">
                                    <i class="fa-solid fa-clock"></i>
                                    10:00am - 03:20pm </a>
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <a class="th-btn style-border1 th-icon" href="event-details.html">Details</a>
                        </div>
                    </div>
                </div>

                <div class="event-card wow fadeInUp" data-wow-delay=".6s">
                    <div class="event-card-img global-img">
                        <img src="assets/img/event/event-1-3.jpg" alt="event">
                        <p class="event-card-tag"><span class="tag-number">22</span>Sep</p>
                    </div>
                    <div class="event-content">
                        <div class="event-wrapp">
                            <h3 class="box-title text-anim2"><a href="event-details.html">The Future of Archives in the Digital Age</a></h3>
                            <p class="box-text">This talk explores the potential future of archives in the digital age, using one of the oldest philosophical archives and research institutes for philosophy in Germany</p>
                            <div class="blog-meta">
                                <a class="location" href="#">
                                    <i class="fa-solid fa-location-dot"></i>
                                    25 Circular Road, New York City </a>
                                <a class="date" href="#">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    14.11.2025 </a>
                                <a class="time" href="#">
                                    <i class="fa-solid fa-clock"></i>
                                    11:00am - 04:00pm </a>
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <a class="th-btn style-border1 th-icon" href="event-details.html">Details</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="apply-stadum-area bg-title position-relative space overflow-hidden">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-between">
                <div class="col-xl-6 order-1 order-xl-0">
                    <div class="apply-stadum-titlebox title-area ">
                        <div class="sec-title-wrap">
                            <span class="sub-title text-anim">APPLY TO Aalokbortika</span>
                            <h2 class="sec-title text-white text-anim2">We are one of the largest university</h2>
                        </div>
                        <div class="box-text-wrap">
                            <p class="box-text text-white mt-25 wow fadeInUp" data-wow-delay=".2s">A place to provide students with enough knowledge and skills in a complex world. Are you looking for exceptional education experience? Aalokbortika might be the place for you.
                            <p>
                        </div>
                    </div>
                    <div class="apply-stadum-wrapp">
                        <div class="apply-stadum-box">
                            <div class="checklist">
                                <ul class="list-unstyled">
                                    <li class="wow fadeInUp" data-wow-delay=".2s"> Undergraduate Admissions</li>
                                    <li class="wow fadeInUp" data-wow-delay=".3s"> Graduate Admissions</li>
                                    <li class="wow fadeInUp" data-wow-delay=".4s"> International Students </li>
                                    <li class="wow fadeInUp" data-wow-delay=".5s"> Scholarship Opportunities </li>
                                </ul>
                            </div>
                            <div class="checklist">
                                <ul class="list-unstyled">
                                    <li class="wow fadeInUp" data-wow-delay=".6s"> Transfer Admissions</li>
                                    <li class="wow fadeInUp" data-wow-delay=".7s"> Financial Aid Applications</li>
                                    <li class="wow fadeInUp" data-wow-delay=".8s"> Scholarship Opportunities </li>
                                    <li class="wow fadeInUp" data-wow-delay=".9s">Campus Visit Scheduling </li>
                                </ul>
                            </div>
                        </div>
                        <div class="apply-stadum-action th-btn-wrap wow fadeInUp" data-wow-delay=".10s">
                            <a href="contact.html" class="th-btn th-icon white-hover">
                                More About Admission </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 order-0 order-xl-1">
                    <div class="apply-stadum-thumb reveal">
                        <img src="assets/img/apply-stadum/apply-stadum-home-1.jpg" alt="image" class="">
                    </div>
                </div>
            </div>
        </div>
        <span class="apply-stadum-shape wow fadeInRight" data-wow-delay=".3s"></span>
    </section>
    <section class="chancellor-area position-relative space">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6">
                    <div class="chancellor-thumb">
                        <img src="assets/img/chancellor/chancellor-img-home-1.jpg" alt="image">
                        <div class="ripple-shape style2">
                            <span class="ripple-1"></span>
                            <span class="ripple-2"></span>
                            <span class="ripple-3"></span>
                            <span class="ripple-4"></span>
                            <span class="ripple-5"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="chancellor-wrapp">
                        <div class="chancellor-titlebox title-area">
                            <span class="sub-title text-anim">OUR CHANCELLOR & LECTURE</span>
                            <h2 class="sec-title text-anim2">Chancellor & Lecturer
                            </h2>
                            <p class="box-text mt-25 wow fadeInUp" data-wow-delay=".4s">A place to provide
                                students with enough knowledge and skills in a complex world. Are you looking for
                                exceptional
                                education experience? Aalokbortika might be the place for you.</p>
                        </div>
                        <div class="chancellor-content">
                            <!--==============================
Skill Area Home 1 
==============================-->

                            <div class="skill-feature wow fadeInUp" data-wow-delay=".2s">
                                <h3 class="skill-feature-title">Faculty Skilled</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 95%;">
                                        <div class="progress-value">95%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-feature wow fadeInUp" data-wow-delay=".4s">
                                <h3 class="skill-feature-title">Computer Science</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 98%;">
                                        <div class="progress-value">98%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-feature wow fadeInUp" data-wow-delay=".6s">
                                <h3 class="skill-feature-title">Communication</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 95%;">
                                        <div class="progress-value">95%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="chancellor-bottom">
                                <div class="chancellor-action">
                                    <a href="contact.html" class="th-btn th-icon">Lecturer at Faculty</a>
                                </div>
                                <div class="chancellor-signature-box text-sm-center">
                                    <p class="box-text">Prof. Dr. Simons Doe, Ph.D</p>
                                    <img src="assets/img/icon/signature.png" class="chancellor-signature" alt="signature">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--==============================
Marquee Area  
==============================-->
    <div class="marquee-area space-bottom overflow-hidden">
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
    <div class="community-area space" data-bg-src="assets/img/bg/community-home-1.png">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="community-wrap">
                        <div class="title-area">
                            <span class="sub-title text-anim">INTERESTED IN JOINING WITH US?</span>
                            <h2 class="sec-title text-anim2 mb-55">Join Us For Information About New Student Admission</h2>
                            <div class="box-text-wrap mt-30 wow fadeInUp" data-wow-delay=".3s">
                                <p class="box-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                            </div>
                        </div>
                        <div class="btn-wrap wow fadeInUp" data-wow-delay=".4s">
                            <a href="contact.html" class="th-btn th-icon"> Join Community </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
Faq Area 1
==============================-->
    <section class="faq-area-1 position-relative space overflow-hidden">
        <div class="faq-shape1 shape-mockup" data-top="0%" data-left="0%">
            <img src="assets/img/shape/feature-shep-home-1.png" alt="shape">
        </div>
        <div class="faq-shape2 shape-mockup" data-bottom="0%" data-right="0%">
            <img src="assets/img/shape/feature-shep-2-home-1.png" alt="shape">
        </div>
        <div class="faq-shape3 movingX shape-mockup" data-bottom="0%" data-right="2%">
            <img src="assets/img/shape/faq-1-1.png" alt="shape">
        </div>
        <div class="ripple-shape d-none d-xl-block">
            <span class="ripple-1"></span>
            <span class="ripple-2"></span>
            <span class="ripple-3"></span>
            <span class="ripple-4"></span>
            <span class="ripple-5"></span>
        </div>
        <div class="container">
            <div class="row gy-30 gx-30 align-items-center justify-content-center">
                <div class="col-xxl-4">
                    <div class="faq-imgbox wow fadeInLeft" data-wow-delay=".3s">
                        <div class="img1">
                            <img src="assets/img/faq/faq-1-2.jpg" alt="image">
                            <img src="assets/img/faq/faq-1-1.jpg" alt="image">
                        </div>
                        <div class="img2">
                            <img src="assets/img/faq/faq-1-3.jpg" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8">
                    <div class="faq-content">
                        <div class="faq-wrap">
                            <div class="title-area">
                                <span class="sub-title text-anim">FAQ</span>
                                <h2 class="sec-title text-anim2">Frequently Ask Questions</h2>
                                <p class="box-text mt-20 wow fadeInUp" data-wow-delay=".3s">We are committed to leaving the world a better place. We pursue new technology, encourage creativity, </p>
                            </div>
                        </div>
                        <div class="faq-box">

                            <!--==============================
Faq Area
==============================-->
                            <div class="faq-wrap1">
                                <div class="accordion" id="faqAccordion">


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".1s">
                                        <div class="accordion-header" id="collapse-item-1">
                                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">01. How this Aalokbortika works?</button>
                                        </div>
                                        <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="collapse-item-1" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".2s">
                                        <div class="accordion-header" id="collapse-item-2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">02. How can i make Cancel here?</button>
                                        </div>
                                        <div id="collapse-2" class="accordion-collapse collapse " aria-labelledby="collapse-item-2" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".3s">
                                        <div class="accordion-header" id="collapse-item-3">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">03. What services do yo offer?</button>
                                        </div>
                                        <div id="collapse-3" class="accordion-collapse collapse " aria-labelledby="collapse-item-3" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".4s">
                                        <div class="accordion-header" id="collapse-item-4">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">04. How can consultant benefits in my business?</button>
                                        </div>
                                        <div id="collapse-4" class="accordion-collapse collapse " aria-labelledby="collapse-item-4" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".5s">
                                        <div class="accordion-header" id="collapse-item-5">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">05. How to get all programs?</button>
                                        </div>
                                        <div id="collapse-5" class="accordion-collapse collapse " aria-labelledby="collapse-item-5" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-card wow fadeInUp" data-wow-delay=".6s">
                                        <div class="accordion-header" id="collapse-item-6">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">06. When available community join?</button>
                                        </div>
                                        <div id="collapse-6" class="accordion-collapse collapse " aria-labelledby="collapse-item-6" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p class="faq-text">At Aalokbortika eductin, we redefine consultancy through a dynamic fusion of innovation, expertise, and strategic vision. Our dedicated team is committed to delivering tailored solutions that transcend traditional consulting boundaries.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--==============================
Blog Area 1
==============================-->
    <section class="blog-area-1 overflow-hidden space" id="blog-sec">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-8 col-12">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title text-anim">LATEST NEWS & BLOG</span>
                        <h2 class="sec-title text-anim2">Blog & Insights</h2>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".3s">
                        <a href="blog.html" class="th-btn style-border1 th-icon"> Our Blogs </a>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="blog-card wow fadeInUp">
                        <div class="blog-img position-relative">
                            <a href="blog-details.html">
                                <div class="blog-img-box position-relative overflow-hidden">
                                    <img src="assets/img/blog/blog_1_1.jpg" alt="blog image">
                                    <img src="assets/img/blog/blog_1_1.jpg" alt="blog image">
                                </div>
                            </a>
                            <div class="blog-date">
                                <h5 class="blog-date-title">24</h5>
                                <p class="blog-date-text">FEB,2025</p>
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>By themeholy</a>
                                <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment
                                </a>
                            </div>
                            <h3 class="box-title"><a href="blog-details.html">Platform Innovation Centre & Parkade for generation</a></h3>
                            <p class="box-text">Studam fuels student success through smart tools and guides for academic excellence.</p>
                            <div class="btn-wrap">
                                <a href="blog-details.html" class="th-btn style-border1 th-icon">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-card wow fadeInUp">
                        <div class="blog-img position-relative">
                            <a href="blog-details.html">
                                <div class="blog-img-box position-relative overflow-hidden">
                                    <img src="assets/img/blog/blog_1_2.jpg" alt="blog image">
                                    <img src="assets/img/blog/blog_1_2.jpg" alt="blog image">
                                </div>
                            </a>
                            <div class="blog-date">
                                <h5 class="blog-date-title">29</h5>
                                <p class="blog-date-text">JAN,2025</p>
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>By themeholy</a>
                                <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment
                                </a>
                            </div>
                            <h3 class="box-title"><a href="blog-details.html">Olympic Plaza Transformar Advence project</a></h3>
                            <p class="box-text">Studam enables learners with powerful tools and support for every education phase.</p>
                            <div class="btn-wrap">
                                <a href="blog-details.html" class="th-btn style-border1 th-icon">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-card wow fadeInUp">
                        <div class="blog-img position-relative">
                            <a href="blog-details.html">
                                <div class="blog-img-box position-relative overflow-hidden">
                                    <img src="assets/img/blog/blog_1_3.jpg" alt="blog image">
                                    <img src="assets/img/blog/blog_1_3.jpg" alt="blog image">
                                </div>
                            </a>
                            <div class="blog-date">
                                <h5 class="blog-date-title">18</h5>
                                <p class="blog-date-text">FEB,2025</p>
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="blog.html">
                                    <span class="author-icon"><img src="assets/img/blog/author.png" alt="img"></span>By themeholy</a>
                                <a href="blog.html"><span class="comment-icon"><i class="fa-solid fa-comments"></i></span> 0 Comment
                                </a>
                            </div>
                            <h3 class="box-title"><a href="blog-details.html">Calgary Municipal Land Corporation launches</a></h3>
                            <p class="box-text">Studam builds strong student networks and platforms for academic transformation daily.</p>
                            <div class="btn-wrap">
                                <a href="blog-details.html" class="th-btn style-border1 th-icon">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section><!--==============================
	Footer Area
==============================-->
    <footer class="footer-wrapper footer-default footer-overlay" data-bg-src="assets/img/bg/footer-bg-1.jpg">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-40 align-items-center justify-content-between">
                    <div class="col-xl-auto">
                        <div class="footer-logo z-index-common" data-cue="slideInLeft">
                            <a href="home-university.html">
                                <img src="assets/img/logo-white.svg" alt="Aalokbortika">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-auto">
                        <div class="client-group-wrap z-index-common" data-cue="slideInRight">
                            <img src="assets/img/normal/client-group1.png" alt="img">
                            <h4 class="title">Have any question?
                                <a href="contact.html"><img src="assets/img/icon/chat2.svg" alt=""> <span class="text-theme">Live</span></a> chat now
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="widget-area">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget footer-widget">
                            <div class="th-widget-about">
                                <h3 class="widget_title">About Aalokbortika</h3>
                                <p class="about-text">Since 1999, when the newly minted Aalokbortika team embraced its mandate to breathe new life into the downtrodden neighbourhood, East Village’s transformation has been nothing short of remarkable. </p>
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
                    </div>
                    <div class="col-sm-6 col-xl-auto">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Useful Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="index.html">Students</a></li>
                                    <li><a href="about.html">Admission</a></li>
                                    <li><a href="pricing.html">Faculty & Stuffs</a></li>
                                    <li><a href="service.html">Media Relations</a></li>
                                    <li><a href="about.html">Alumni</a></li>
                                    <li><a href="about.html">All Awards</a></li>
                                    <li><a href="contact.html">Recent Events</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-auto">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Our Programs</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="about.html">Ungraduate Programs</a></li>
                                    <li><a href="about.html">Graduate Programs</a></li>
                                    <li><a href="about.html">Certificate Programs</a></li>
                                    <li><a href="about.html">Accelerate Programs</a></li>
                                    <li><a href="about.html">Online Programs</a></li>
                                    <li><a href="about.html">Financial Planning</a></li>
                                    <li><a href="about.html">Business Advisory</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget th-widget-instagram footer-widget">
                            <h3 class="widget_title">Instagram</h3>
                            <div class="instagram-feeds">
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-1.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-1.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-2.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-2.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-3.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-3.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-4.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-4.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-5.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-5.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-6.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-6.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-7.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-7.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-8.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-8.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="insta-thumb">
                                    <img src="assets/img/widget/insta-feed-1-9.jpg" alt="Image">
                                    <a href="assets/img/widget/insta-feed-1-9.jpg" class="insta-btn popup-image"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap z-index-common">
            <div class="container">
                <div class="row justify-content-center gy-3 align-items-center">
                    <div class="col-lg-6">
                        <p class="copyright-text">
                            <i class="fal fa-copyright"></i> Copyright 2025 <a href="home-university.html">Aalokbortika</a>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <div class="footer-links">
                            <ul>
                                <li><a href="about.html">Privacy Policy</a></li>
                                <li><a href="about.html">Terms of services</a></li>
                                <li><a href="about.html">Disclaimer</a></li>
                            </ul>
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
                <button class="nav-menu" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-menu active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Register</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> 
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

            <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="th-form-title mb-30">Sign in to your account</h3>
                <form action="mail.php" method="POST" class="login-form ajax-contact">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Username*</label>
                            <input type="text" class="form-control" name="usename" id="usename" required="required">
                        </div>
                        <div class="form-group col-12">
                            <label>First name*</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" required="required">
                        </div>
                        <div class="form-group col-12">
                            <label>Last name*</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" required="required">
                        </div>
                        <div class="form-group col-12">
                            <label for="new_email">Your email*</label>
                            <input type="text" class="form-control" name="new_email" id="new_email" required="required">
                        </div>
                        <div class="form-group col-12">
                            <label for="new_email_confirm">Confirm email*</label>
                            <input type="text" class="form-control" name="new_email_confirm" id="new_email_confirm" required="required">
                        </div>
                        <div class="statement">
                            <span class="register-notes">A password will be emailed to you.</span>
                        </div>

                        <div class="form-btn mt-20 col-12">
                            <button class="th-btn btn-fw th-radius2 ">Sign up</button>
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </form>
            </div>
        </div>
    </div>
    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <!-- Swiper Js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Wow Js -->
    <script src="assets/js/wow.min.js"></script>

    <!-- Gsap Animation -->
    <script src="assets/js/gsap.min.js"></script>
    <!-- ScrollTrigger -->
    <script src="assets/js/ScrollTrigger.min.js"></script>
    <!-- SplitText -->
    <script src="assets/js/SplitText.min.js"></script>
    <!-- Lenis Js -->
    <script src="assets/js/lenis.min.js"></script>
    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>

</body>

</html>