@if(session('success'))
    <div id="alert" class="bg-green-600-500-900 text-center py-4 lg:px-4">
        <div onclick="closeAlert(event)" class="p-2 bg-green-600 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-green-600 uppercase px-2 py-1 text-xs font-bold mr-3">Info</span>
            <span class="font-semibold mr-2 text-left flex-auto">{{session('success')}}</span>
        </div>
    </div>
    <script>
        function closeAlert(event){
            let element = event.target;
            while(element.nodeName !== "DIV"){
                element = element.parentNode;
            }
            element.parentNode.parentNode.removeChild(element.parentNode);
        }
    </script>
@endif
