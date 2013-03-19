<style>
.wayne-toolbar-outer {
  font: 12px helvetica, arial, sans-serif;
  
  position: absolute;
  bottom: 0;
  left:   0;
  width: 100%;
  height: 52px;
  
  color: #F1F1F1;
  border-top: 1px solid rgba(0, 0, 0, .1);
  background: #2f3030;
  background-image: linear-gradient(bottom, rgb(41,41,41) 0%, rgb(47,48,48) 100%);
  background-image: -o-linear-gradient(bottom, rgb(41,41,41) 0%, rgb(47,48,48) 100%);
  background-image: -moz-linear-gradient(bottom, rgb(41,41,41) 0%, rgb(47,48,48) 100%);
  background-image: -webkit-gradient(
    linear,
    left bottom,
    left top,
    color-stop(0, rgb(41,41,41)),
    color-stop(1, rgb(47,48,48))
  );
}

.wayne-toolbar a {
  text-decoration: none;
}

.wayne-widget {
  height: 52px;
  float: left;
  color: #E1E1E1;
  text-shadow: 0 1px 1px rgba(0, 0, 0, .3);
}

.wayne-branding {
  padding: 18px 10px;
  display: block;
  
  font-size: 14px;
  font-weight: bold;
  
  color: #121212;
  background: #292929;
  
  text-shadow: 0 1px 0 rgba(255, 255, 255, .1);
  -moz-transition: 0.2s;
  -webkit-transition: 0.2s;
  transition: 0.2s;
}
  .wayne-branding:hover {
    color: white;
    text-shadow: none;
  }

</style>