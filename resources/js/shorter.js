window.shorter = {
    short_url: () => {
        let long_url = document.getElementById('long_url').value;

        if (shorter.validate_url(long_url)) {
            axios.post('/url', {
                long_url: long_url
            })
                .then(res=>{
                    document.getElementById('long_url').value = '';
                    document.getElementById('short_url_container').style.display = 'block';
                    document.getElementById('short_url').value = res.data.short_url;
                })
                .catch(err=>{
                    console.log(err.response.data)
                })
        }
    },
    copy_url: () => {
        let short_url = document.getElementById('short_url');
        short_url.select();
        short_url.setSelectionRange(0,9999);
        document.execCommand('copy');
    },
    validate_url: (url) => {
        let status = true;
        if(url.trim() === ""){
            alert('Debe colocar una URL');
            return status = false;
        }
        if(!validURL(url)){
            alert('URL no válida');
            return status = false;
        }
        return status;
    }
}

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}
