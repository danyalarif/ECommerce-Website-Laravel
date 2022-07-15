function countdown()
{
    let countDown = document.getElementsByClassName('countdown')[0]
    let time = countDown.innerHTML.split(':')
    let h = time[0]
    let m = time[1]
    let s = time[2]
    let newh = h
    let newm = m
    let news = null
    if (s.localeCompare('00') == 0)
    {
        news = '59'
        if (m.localeCompare('00') != 0)
        {
            newm = (parseInt(m) - 1).toString()
        }
    }
    if (m.localeCompare('00') == 0)
    {
        newm = '59'
        if (h.localeCompare('00') != 0)
        {
            newh = (parseInt(h) - 1).toString()
        }
        else
        {
            //if time reaches the end
        }
    }
    if (s.localeCompare('00') != 0)
    {
        news = (parseInt(s) - 1).toString()
    }
    if (news.length == 1)
    {
        news = '0' + news
    }
    if (newm.length == 1)
    {
        newm = '0' + newm
    }
    if (newh.length == 1)
    {
        newh = '0' + newh
    }
    countDown.innerHTML = newh + ':' + newm + ':' + news
}

//countdown
setInterval(() => {countdown()}, 1000)