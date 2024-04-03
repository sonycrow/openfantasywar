import * as htmltoimage from 'html-to-image';
window.htmltoimage = htmltoimage;

function generateImages(e)
{
    // // Recorremos las cartas y generamos las imágenes
    // let nodes = document.getElementsByClassName('block');
    //
    // Array.from(nodes).forEach((node) => {
    //     // Configuración
    //     let unitid   = node.getAttribute("data-unitid");
    //     let nameid   = node.getAttribute("data-nameid");
    //     let toImage  = node.getAttribute("data-toimage");
    //     let download = node.getAttribute("data-download");
    //
    //     // Si hay que generar las imagenes
    //     if (toImage == 1) {
    //         htmltoimage.toPng(node)
    //             .then(function (dataUrl) {
    //                 let img = new Image();
    //                 img.src = dataUrl;
    //
    //                 // Descarga de imagenes
    //                 if (download == 1) {
    //                     img.onclick = function() {
    //                         let link = document.createElement('a');
    //                         link.download = nameid + '.png';
    //                         link.href = dataUrl;
    //                         link.click();
    //                     };
    //                 }
    //
    //                 document.getElementById("unit-" + unitid).appendChild(img);
    //                 node.remove();
    //             })
    //             .catch(function (error) {
    //                 console.error('oops, something went wrong!', error);
    //             });
    //     }
    // });
}
