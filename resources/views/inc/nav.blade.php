 <!-- 헤터부분 -->
 <nav class="navbar navbar-expand-lg bg-light">
     <div class="container">
         <a class="navbar-brand" href="{{ url('/') }}">포럼</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="{{ url('/category') }}">Category</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ url('/') }}">Login</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ url('/') }}">register</a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
