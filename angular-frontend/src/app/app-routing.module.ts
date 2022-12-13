import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ListGenreComponent  } from './genre/list-genre/list-genre.component';
import { WelcomeComponent } from './welcome/welcome.component';
import { DeleteGenreComponent } from './genre/delete-genre/delete-genre.component';
import { NewGenreComponent } from './genre/new-genre/new-genre.component';
import { EditGenreComponent } from './genre/edit-genre/edit-genre.component';
import { ListMovieComponent } from './movie/list-movie/list-movie.component';
import { NewMovieComponent } from './movie/new-movie/new-movie.component';
import { DeleteMovieComponent } from './movie/delete-movie/delete-movie.component';
import { EditMovieComponent } from './movie/edit-movie/edit-movie.component';
import { ListActorComponent } from './actor/list-actor/list-actor.component';
import { NewActorComponent } from './actor/new-actor/new-actor.component';
import { DeleteActorComponent } from './actor/delete-actor/delete-actor.component';
import { EditActorComponent } from './actor/edit-actor/edit-actor.component';
import { ListMovieactorComponent } from './movieactor/list-movieactor/list-movieactor.component';
import { DeleteMovieactorComponent } from './movieactor/delete-movieactor/delete-movieactor.component';
import { AddMovieactorComponent } from './movieactor/add-movieactor/add-movieactor.component';
import { EditMovieactorComponent } from './movieactor/edit-movieactor/edit-movieactor.component';
import { ListMovieRegistryComponent } from './list-movie-registry/list-movie-registry.component';
import { ListActorRegistryComponent } from './list-actor-registry/list-actor-registry.component';

const routes: Routes = [
  { path: '', component: WelcomeComponent},
  { path: 'genres', component: ListGenreComponent, title: 'MovieDB | Genres' },
  { path: 'genre/delete/:id', component: DeleteGenreComponent, title: 'MovieDB | Delete Genre'},
  { path: 'genre/add', component: NewGenreComponent, title: 'MovieDB | Add Genre' },
  { path: 'genre/edit/:id', component: EditGenreComponent, title: 'MovieDB | Edit Genre' },
  { path: 'movies', component: ListMovieComponent, title: 'MovieDB | Movies'},
  { path: 'movie/add', component: NewMovieComponent, title: 'MovieDB | Add Movie'},
  { path: 'movie/delete/:id', component: DeleteMovieComponent, title: 'MovieDB | Delete Movie'},
  { path: 'movie/edit/:id', component: EditMovieComponent, title: 'MovieDB | Edit Movie' },
  { path: 'actors', component: ListActorComponent, title: 'MovieDB | Actors'},
  { path: 'actor/add', component: NewActorComponent, title: 'MovieDB | Add Actor'},
  { path: 'actor/delete/:id', component: DeleteActorComponent, title: 'MovieDB | Delete Actor'},
  { path: 'actor/edit/:id', component: EditActorComponent, title: 'MovieDb | Edit Actor' },
  { path: 'movieactors', component: ListMovieactorComponent, title: 'MovieDB | Movie Actors'},
  { path: 'movieactor/delete/:id', component: DeleteMovieactorComponent, title: 'MovieDB | Delete Movie Actor'},
  { path: 'movieactor/add', component: AddMovieactorComponent, title: 'MovieDB | Add Movie Actor'},
  { path: 'movieactor/edit/:id', component: EditMovieactorComponent, title: 'MovieDB | Edit Movie Actor'},
  { path: 'movie/:id/actors', component: ListMovieRegistryComponent, title: 'MovieDB | Actors' },
  { path: 'actor/:id/movies', component: ListActorRegistryComponent, title: 'MovieDB | Movies' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})

export class AppRoutingModule { }
