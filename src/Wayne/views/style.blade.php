<style>
.wayne-toolbar-outer {
  font: 12px helvetica, arial, sans-serif;
  
  position: absolute;
  bottom: 0;
  left:   0;
  width: 100%;
  height: 52px;
  
  color: #F1F1F1;
  padding-top: 1px;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
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
  border-right: 1px solid rgba(0, 0, 0, .1);
  border-left: 1px solid rgba(255, 255, 255, .07);
}
  .wayne-widget-body {
    display: block;
    padding: 18px 10px;
    margin-right: 3px;
  }

.wayne-branding {
  font-size: 14px;
  font-weight: bold;
  
  color: #121212;
  background: #292929;
  
  border-right: 1px solid rgba(0, 0, 0, .2);
  text-shadow: 0 1px 0 rgba(255, 255, 255, .1);
  -moz-transition: 0.2s;
  -webkit-transition: 0.2s;
  transition: 0.2s;
}
  .wayne-branding:hover {
    color: #D2D2D2;
    text-shadow
: none;
  }

{{-- wayne components: --}}
.wayne-button {
  font-weight: bold;
  padding: 3px;
  background-color: #5C5C5C;
  color: #D2D2D2;
  text-shadow: 0 1px 0 rgba(0, 0, 0, .2);
  border-radius: 4px;
  box-shadow: 0 1px 0 rgba(0, 0, 0, .2);
  margin-right: 4px;
}

.wayne-link {
  color: #2FB9A6;
  font-weight: bold;
  margin-right: 3px;
}
  .wayne-link:hover {
    color: #E1E1E1;
  }
</style>