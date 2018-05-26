var beautyof = document.getElementsByTagName("h1")[0];
var welcomeind = document.getElementsByTagName("h2")[0];
var allh3 = document.getElementsByTagName("h3");

  function changeInd() {
    beautyof.innerHTML = "Keindahan Indonesia";
    welcomeind.innerHTML = "Selamat Datang di Indonesia";
    allh3[0].innerHTML = "KAMI <bold>BEKERJA KERAS</bold> UNTUK MEMBERIKAN<bold> PELAYANAN YANG TERBAIK</bold>. MISI KAMI ADALAH <bold>KEPUASAN</bold> ANDA"
    allh3[1].innerHTML = "TENTANG KAMI";
    allh3[2].innerHTML = "KONTAK KAMI";
    allh3[3].innerHTML = "Kirim Kami Pesan";
    allh3[5].innerHTML = "Telepon Kami";
    allh3[7].innerHTML = "Kami di Sosial Media";
  }

  function changeEng() {
    beautyof.innerHTML = "Beauty of Indonesia";
    welcomeind.innerHTML = "Welcome to Indonesia";
    allh3[0].innerHTML = "WE <bold>WORK HARD</bold> TO DELIVER A <bold>HIGH QUALITY SERVICE</bold>. OUR AIM IS YOUR COMPLETE <bold>SATISFACTION</bold>"
    allh3[1].innerHTML = "ABOUT US";
    allh3[2].innerHTML = "CONTACT US";
    allh3[3].innerHTML = "Send Us Message";
    allh3[5].innerHTML = "Call Us";
    allh3[7].innerHTML = "We Are Social";
  }
