//switch styles for navigation in frames of profile

function switch_selected(id) {
    let myLast = document.querySelector("div[selected]")
    let current = document.getElementById(id)

    myLast.removeAttribute("selected")
    current.setAttribute("selected", "")

    let iframe = document.getElementById('iframe')

    let route = '/profile/' + id
    console.log(route)

    iframe.setAttribute('src', route)
}
