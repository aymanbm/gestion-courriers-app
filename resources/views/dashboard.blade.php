<x-master title="لوحة التحكم" css="css/dashboard.css" :active1="$active1" :active2="$active2" :active3="$active3" :active4="$active4">
<div class=" h-full">

        <div class= "dashboard text-white grid grid-row gap-9 pt-24 place-items-center">
            <div class="row1 text-white grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2  md:gap-16 lg:gap-28 sm:gap-10">
                <a href={{route("courriers.index",['type'=>"مرسلة",'title'=>"البريد المرسل",'date'=>"تاريخ الارسال"])}} class="no-underline">
                    <div class="envoyer lg:w-96 md:w-80 sm:w-64 w-full text-xl font-semibold p-2 border-2 rounded-lg bg-[#012D6F]">
                        <span class="icon " style="text-align:end !important;"><img src={{asset("img/ico.svg")}} class="h-10 m-2 mb-4 mr-auto" alt=""></span>
                        <div class="title p-4 pl-20" >البريد المرسل</div>
                        <div class="nb-courrier " style="text-align:end !important;">{{$nb_courriers_envoyer}}</div>
                    </div>
                </a>
                <a href={{route("courriers.index",['type'=>"مستلمة",'title'=>"البريدالمستلم",'date'=>"تاريخ الاستلام"])}} class="no-underline">
                    <div class="envoyer lg:w-96 md:w-80 sm:w-64 w-full text-xl font-semibold p-2 border-2 rounded-lg bg-[#012D6F]">
                        <span class="icon " style="text-align:end !important;"><img src={{asset("img/ico.svg")}} class="h-10 m-2 mb-4 mr-auto" alt=""></span>
                        <div class="title p-4 pl-20" >البريدالمستلم</div>
                        <div class="nb-courrier " style="text-align:end !important;">{{$nb_courriers_reçu}}</div>
                    </div>
                </a>
            </div>

            <div class="row2 text-white grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 md:gap-16 lg:gap-28 sm:gap-10">
                <a href={{route("courriers.index",['type'=>"المرسل المعالج",'title'=>"البريد المرسل المعالج",'date'=>"تاريخ الارسال"])}} class="no-underline">
                    <div class="envoyer lg:w-96 md:w-80 sm:w-64 w-full text-xl font-semibold p-2 border-2 rounded-lg bg-[#00BF63]">
                        <span class="icon " style="text-align:end !important;"><img src={{asset("img/ico.svg")}} class="h-10 m-2 mb-4 mr-auto" alt=""></span>
                        <div class="title p-4 pl-20" >البريد المرسل المعالج</div>
                        <div class="nb-courrier " style="text-align:end !important;">{{$nb_courriers_envoyer_traiter}}</div>
                    </div>
                </a>
                <a href={{route("courriers.index",['type'=>"المستلم المعالج",'title'=>"البريد المستلم المعالج",'date'=>"تاريخ الاستلام"])}} class="no-underline">
                    <div class="envoyer lg:w-96 md:w-80 sm:w-64 w-full text-xl font-semibold p-2 border-2 rounded-lg bg-[#00BF63]">
                        <span class="icon " style="text-align:end !important;"><img src={{asset("img/ico.svg")}} class="h-10 m-2 mb-4 mr-auto" alt=""></span>
                        <div class="title p-4 pl-20" >البريد المستلم المعالج</div>
                        <div class="nb-courrier " style="text-align:end !important;">{{$nb_courriers_reçu_traiter}}</div>
                    </div>
                </a>
            </div>

        </div>
</div>
</x-master>
