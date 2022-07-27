<form action ="create" method = "POST" enctype="multipart/form-data"> 
    <input type= "text" placeholder="name" name ="name" />
    <input type= "text" placeholder="description" name ="description" />
    <input type= "number" placeholder="price" name ="price" />
    <input type= "number" placeholder="stock" name ="stock" />
    <input type= "number" placeholder="priceSale" name ="priceSale" />
    <input type= "checkbox" placeholder="state" name ="state" />
    <input type= "file" multiple placeholder="" name ="files[]" />
    <button>create </button>
</form>