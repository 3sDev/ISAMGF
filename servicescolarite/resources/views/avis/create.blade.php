@extends('adminlayoutscolarite.layout')
@section('title', 'Créer nouveau avis')
@section('contentPage')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau avis</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('avis') }}">Liste des avis</a></li>
                <li class="breadcrumb-item active">Nouveau avis</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
.styleTag{
    background-color: darkgray;
    font-size: 15px;
    padding: 8px 15px;
    border-radius: 8px;
    margin-right: 2%;
}

.selectMultiple {
  width: 100% !important;
  position: relative;
}
.selectMultiple select {
  display: none;
}
.selectMultiple > div {
  position: relative;
  z-index: 2;
  padding: 8px 12px 2px 12px;
  border-radius: 8px;
  background: #fff;
  font-size: 14px;
  min-height: 40px;
  box-shadow: 0 4px 16px 0 rgba(22, 42, 90, 0.12);
  transition: box-shadow 0.3s ease;
  border: 1px solid gray;
}
.selectMultiple > div:hover {
  box-shadow: 0 4px 24px -1px rgba(22, 42, 90, 0.16);
}
.selectMultiple > div .arrow {
  right: 1px;
  top: 0;
  bottom: 0;
  cursor: pointer;
  width: 28px;
  position: absolute;
}
.selectMultiple > div .arrow:before, .selectMultiple > div .arrow:after {
  content: "";
  position: absolute;
  display: block;
  width: 2px;
  height: 8px;
  border-bottom: 8px solid #99A3BA;
  top: 43%;
  transition: all 0.3s ease;
}
.selectMultiple > div .arrow:before {
  right: 12px;
  transform: rotate(-130deg);
}
.selectMultiple > div .arrow:after {
  left: 9px;
  transform: rotate(130deg);
}
.selectMultiple > div span {
  color: #99A3BA;
  display: block;
  position: absolute;
  left: 12px;
  cursor: pointer;
  top: 8px;
  line-height: 28px;
  transition: all 0.3s ease;
}
.selectMultiple > div span.hide {
  opacity: 0;
  visibility: hidden;
  transform: translate(-4px, 0);
}
.selectMultiple > div a {
  position: relative;
  padding: 0 24px 6px 8px;
  line-height: 28px;
  color: #1E2330;
  display: inline-block;
  vertical-align: top;
  margin: 0 6px 0 0;
}
.selectMultiple > div a em {
  font-style: normal;
  display: block;
  white-space: nowrap;
}
.selectMultiple > div a:before {
  content: "";
  left: 0;
  top: 0;
  bottom: 6px;
  width: 100% !important;
  position: absolute;
  display: block;
  background: rgba(228, 236, 250, 0.7);
  z-index: -1;
  border-radius: 4px;
}
.selectMultiple > div a i {
  cursor: pointer;
  position: absolute;
  top: 0;
  right: 0;
  width: 24px;
  height: 28px;
  display: block;
}
.selectMultiple > div a i:before, .selectMultiple > div a i:after {
  content: "";
  display: block;
  width: 2px;
  height: 10px;
  position: absolute;
  left: 50%;
  top: 50%;
  background: #4D18FF;
  border-radius: 1px;
}
.selectMultiple > div a i:before {
  transform: translate(-50%, -50%) rotate(45deg);
}
.selectMultiple > div a i:after {
  transform: translate(-50%, -50%) rotate(-45deg);
}
.selectMultiple > div a.notShown {
  opacity: 0;
  transition: opacity 0.3s ease;
}
.selectMultiple > div a.notShown:before {
  width: 28px;
  transition: width 0.45s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0.2s;
}
.selectMultiple > div a.notShown i {
  opacity: 0;
  transition: all 0.3s ease 0.3s;
}
.selectMultiple > div a.notShown em {
  opacity: 0;
  transform: translate(-6px, 0);
  transition: all 0.4s ease 0.3s;
}
.selectMultiple > div a.notShown.shown {
  opacity: 1;
}
.selectMultiple > div a.notShown.shown:before {
    width: 100% !important;
}
.selectMultiple > div a.notShown.shown i {
  opacity: 1;
}
.selectMultiple > div a.notShown.shown em {
  opacity: 1;
  transform: translate(0, 0);
}
.selectMultiple > div a.remove:before {
  width: 28px;
  transition: width 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0s;
}
.selectMultiple > div a.remove i {
  opacity: 0;
  transition: all 0.3s ease 0s;
}
.selectMultiple > div a.remove em {
  opacity: 0;
  transform: translate(-12px, 0);
  transition: all 0.4s ease 0s;
}
.selectMultiple > div a.remove.disappear {
  opacity: 0;
  transition: opacity 0.5s ease 0s;
}
.selectMultiple > ul {
  margin: 0;
  padding: 0;
  list-style: none;
  font-size: 16px;
  z-index: 1;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  visibility: hidden;
  opacity: 0;
  border-radius: 8px;
  transform: translate(0, 20px) scale(0.8);
  transform-origin: 0 0;
  filter: drop-shadow(0 12px 20px rgba(22, 42, 90, 0.08));
  transition: all 0.4s ease, transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44), filter 0.3s ease 0.2s;
}
.selectMultiple > ul li {
  color: #1E2330;
  background: #fff;
  padding: 12px 16px;
  cursor: pointer;
  overflow: hidden;
  position: relative;
  transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease 0.3s, opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s;
}
.selectMultiple > ul li:first-child {
  border-radius: 8px 8px 0 0;
}
.selectMultiple > ul li:first-child:last-child {
  border-radius: 8px;
}
.selectMultiple > ul li:last-child {
  border-radius: 0 0 8px 8px;
}
.selectMultiple > ul li:last-child:first-child {
  border-radius: 8px;
}
.selectMultiple > ul li:hover {
  background: #4D18FF;
  color: #fff;
}
.selectMultiple > ul li:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 6px;
  height: 6px;
  background: rgba(0, 0, 0, 0.4);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%, -50%);
  transform-origin: 50% 50%;
}
.selectMultiple > ul li.beforeRemove {
  border-radius: 0 0 8px 8px;
}
.selectMultiple > ul li.beforeRemove:first-child {
  border-radius: 8px;
}
.selectMultiple > ul li.afterRemove {
  border-radius: 8px 8px 0 0;
}
.selectMultiple > ul li.afterRemove:last-child {
  border-radius: 8px;
}
.selectMultiple > ul li.remove {
  transform: scale(0);
  opacity: 0;
}
.selectMultiple > ul li.remove:after {
  -webkit-animation: ripple 0.4s ease-out;
          animation: ripple 0.4s ease-out;
}
.selectMultiple > ul li.notShown {
  display: none;
  transform: scale(0);
  opacity: 0;
  transition: transform 0.35s ease, opacity 0.4s ease;
}
.selectMultiple > ul li.notShown.show {
  transform: scale(1);
  opacity: 1;
}
.selectMultiple.open > div {
  box-shadow: 0 4px 20px -1px rgba(22, 42, 90, 0.12);
}
.selectMultiple.open > div .arrow:before {
  transform: rotate(-50deg);
}
.selectMultiple.open > div .arrow:after {
  transform: rotate(50deg);
}
.selectMultiple.open > ul {
  transform: translate(0, 12px) scale(1);
  opacity: 1;
  visibility: visible;
  filter: drop-shadow(0 16px 24px rgba(22, 42, 90, 0.16));
}

@-webkit-keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 1;
  }
  25% {
    transform: scale(30, 30);
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(50, 50);
  }
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 1;
  }
  25% {
    transform: scale(30, 30);
    opacity: 1;
  }
  100% {
    opacity: 0;
    transform: scale(50, 50);
  }
}
</style>
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ url('avis') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Titre</label>
                                    <input type="text" name="titre" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                                <div class="col-md-6" style="display: none;">
                                    <label for="">Adresse</label>
                                    <input type="text" name="adresse" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Classe</label>
                                    <select name="classe_id[]" class="form-control" multiple data-placeholder="Séléctionner classe(s)" required>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" style="display:none;">
                                    <label for="">Type</label>
                                    <select name="type" class="form-control" required>
                                        <option value="Scolarité">Scolarité</option>
                                        <option value="Enseignant">Enseignant</option>
                                        <option value="Personnel">Personnel</option>
                                    </select>
                                </div>
                            </div>
                            <br><hr><br><br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Image d'avis</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Fichier (PDF)</label>
                                    <input type="file" name="fichier" class="form-control">
                                </div>
                            </div>
                            <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">ajouter</button>
                            </div>
                       
                        </form>

                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {

var select = $('select[multiple]');
var options = select.find('option');

var div = $('<div />').addClass('selectMultiple');
var active = $('<div />');
var list = $('<ul />');
var placeholder = select.data('placeholder');

var span = $('<span />').text(placeholder).appendTo(active);

options.each(function() {
    var text = $(this).text();
    if($(this).is(':selected')) {
        active.append($('<a />').html('<em>' + text + '</em><i></i>'));
        span.addClass('hide');
    } else {
        list.append($('<li />').html(text));
    }
});

active.append($('<div />').addClass('arrow'));
div.append(active).append(list);

select.wrap(div);

$(document).on('click', '.selectMultiple ul li', function(e) {
    var select = $(this).parent().parent();
    var li = $(this);
    if(!select.hasClass('clicked')) {
        select.addClass('clicked');
        li.prev().addClass('beforeRemove');
        li.next().addClass('afterRemove');
        li.addClass('remove');
        var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
        a.slideDown(400, function() {
            setTimeout(function() {
                a.addClass('shown');
                select.children('div').children('span').addClass('hide');
                select.find('option:contains(' + li.text() + ')').prop('selected', true);
            }, 500);
        });
        setTimeout(function() {
            if(li.prev().is(':last-child')) {
                li.prev().removeClass('beforeRemove');
            }
            if(li.next().is(':first-child')) {
                li.next().removeClass('afterRemove');
            }
            setTimeout(function() {
                li.prev().removeClass('beforeRemove');
                li.next().removeClass('afterRemove');
            }, 200);

            li.slideUp(400, function() {
                li.remove();
                select.removeClass('clicked');
            });
        }, 600);
    }
});

$(document).on('click', '.selectMultiple > div a', function(e) {
    var select = $(this).parent().parent();
    var self = $(this);
    self.removeClass().addClass('remove');
    select.addClass('open');
    setTimeout(function() {
        self.addClass('disappear');
        setTimeout(function() {
            self.animate({
                width: 0,
                height: 0,
                padding: 0,
                margin: 0
            }, 300, function() {
                var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
                li.slideDown(400, function() {
                    li.addClass('show');
                    setTimeout(function() {
                        select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);
                        if(!select.find('option:selected').length) {
                            select.children('div').children('span').removeClass('hide');
                        }
                        li.removeClass();
                    }, 400);
                });
                self.remove();
            })
        }, 300);
    }, 400);
});

$(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
    $(this).parent().parent().toggleClass('open');
});

});
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
@endsection