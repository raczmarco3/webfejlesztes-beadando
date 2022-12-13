import { Component } from '@angular/core';
import { Subscription } from 'rxjs';
import { ActivatedRoute } from '@angular/router';
import { Genre } from '../../model/genre';
import { GenreService } from '../../service/genre-service';

@Component({
  selector: 'app-edit-genre',
  templateUrl: './edit-genre.component.html',
  styleUrls: ['./edit-genre.component.css']
})
export class EditGenreComponent {
 
  private routeSub: Subscription;
  genre: Genre;
  isFetching: boolean;
  id: number;
  msg: any;
  jsonContent: JSON;
  obj: any;

  constructor(private route: ActivatedRoute, private genreService:GenreService) { }

  ngOnInit() {
    this.isFetching = true;
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    });

    this.genreService.getGenre(this.id).subscribe(
      {
        next: (respone) => {
          this.genre = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }  

  onSubmit(ngenre: any) {
    this.obj = {"id": this.id, "name": ngenre.name};
    this.jsonContent = <JSON>this.obj;

    this.isFetching = true;
    this.genreService.editGenre(this.id, this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
